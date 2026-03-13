@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endpush

@section('title', 'Dashboard')
@section('page_subtitle', 'Quick overview of your sales performance and team activity.')
@section('page_actions')
    @if(auth()->user()->hasRole('super_admin'))
        <a href="{{ route('leads.create') }}" class="btn btn-primary">Add Lead</a>
    @endif
    <a href="{{ route('broadcasts.create') }}" class="btn btn-outline-primary">Send Broadcast</a>
    <a href="{{ route('follow-ups.create') }}" class="btn btn-outline-primary">Add Follow-up</a>
@endsection

@section('content')
@php
    $isSuperAdmin = auth()->user()->hasRole('super_admin');
    $orgId = $isSuperAdmin ? null : auth()->user()->organization_id;

    $leadBaseQuery = \App\Models\Lead::query();
    if ($orgId) {
        $leadBaseQuery->where('organization_id', $orgId);
    }
    $totalLeads = $stats['leads'] ?? (clone $leadBaseQuery)->count();
    $newLeadsToday = (clone $leadBaseQuery)->whereDate('created_at', now()->toDateString())->count();
    $dealsClosed = (clone $leadBaseQuery)->where('stage', 'closed_won')->count();
    $conversionRate = $totalLeads > 0 ? round(($dealsClosed / $totalLeads) * 100, 1) : 0;
    $pendingFollowUps = \App\Models\FollowUp::when($orgId, fn($q) => $q->where('organization_id', $orgId))
        ->where('status', 'pending')->count();

    $recentFollowUps = \App\Models\FollowUp::with('lead')
        ->when($orgId, fn($q) => $q->where('organization_id', $orgId))
        ->latest()->take(6)->get();

    $upcomingFollowUps = \App\Models\FollowUp::with('lead')
        ->when($orgId, fn($q) => $q->where('organization_id', $orgId))
        ->where('status', 'pending')->where('due_at', '>=', now())->orderBy('due_at')->take(6)->get();

    $todayFollowUps = \App\Models\FollowUp::with('lead')
        ->when($orgId, fn($q) => $q->where('organization_id', $orgId))
        ->where('status', 'pending')
        ->whereDate('due_at', now()->toDateString())
        ->orderBy('due_at')->take(10)->get();

    $overdueFollowUps = \App\Models\FollowUp::with('lead')
        ->when($orgId, fn($q) => $q->where('organization_id', $orgId))
        ->where('status', 'pending')->where('due_at', '<', now())->orderBy('due_at')->take(6)->get();

    $pipelineStages = ['new', 'contacted', 'qualified', 'proposal', 'closed_won', 'closed_lost'];
    $pipelineLabels = [
        'new' => 'New Leads',
        'contacted' => 'Contacted',
        'qualified' => 'Qualified',
        'proposal' => 'Negotiation',
        'closed_won' => 'Closed Won',
        'closed_lost' => 'Closed Lost',
    ];
    $pipelineCounts = [];
    foreach ($pipelineStages as $stage) {
        $q = (clone $leadBaseQuery)->where('stage', $stage);
        $pipelineCounts[$stage] = $q->count();
    }
    $pipelineMax = max(1, max($pipelineCounts));

    $nextFollowUpMap = collect();
    if ($recentLeads->isNotEmpty()) {
        $next = \App\Models\FollowUp::whereIn('lead_id', $recentLeads->pluck('id'))
            ->where('status', 'pending')->where('due_at', '>=', now())
            ->orderBy('due_at')->get()->groupBy('lead_id');
        foreach ($next as $lid => $items) {
            $nextFollowUpMap[$lid] = $items->first();
        }
    }

    $activityItems = collect();
    foreach ($recentLeads->take(6) as $lead) {
        $activityItems->push(['time' => $lead->created_at, 'title' => 'New lead added', 'meta' => $lead->name ?? $lead->phone]);
        if ($lead->updated_at && $lead->updated_at->ne($lead->created_at)) {
            $activityItems->push(['time' => $lead->updated_at, 'title' => 'Pipeline stage updated', 'meta' => ucfirst(str_replace('_', ' ', $lead->stage))]);
        }
    }
    foreach ($recentFollowUps as $followUp) {
        $activityItems->push([
            'time' => $followUp->created_at,
            'title' => 'Follow-up scheduled',
            'meta' => ($followUp->lead->name ?? $followUp->lead->phone ?? 'Lead') . ' • ' . $followUp->due_at->format('M d, H:i'),
        ]);
    }
    $activityItems = $activityItems->sortByDesc('time')->take(6)->values();

    if ($isSuperAdmin) {
        $totalOrgs = $stats['organizations'] ?? \App\Models\Organization::count();
        $totalUsers = \App\Models\User::count();
        $activeSubscriptions = $stats['subscriptions'] ?? \App\Models\Subscription::where('status', 'active')->count();
        $monthlyRevenue = (int) \App\Models\Payment::where('status', 'captured')
            ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount');
        $recentOrganizations = \App\Models\Organization::withCount('users')->latest()->take(5)->get();
        $recentPayments = \App\Models\Payment::with(['organization', 'plan'])->where('status', 'captured')->latest()->take(5)->get();
        $recentBroadcasts = \App\Models\Broadcast::with('organization')->latest()->take(5)->get();
        $plans = \App\Models\Plan::where('is_active', true)->orderBy('price_monthly')->get();
        $planPerformance = [];
        foreach ($plans as $plan) {
            $subs = $plan->subscriptions();
            $planPerformance[] = [
                'plan' => $plan,
                'subscribers' => $subs->count(),
                'active' => $subs->where('status', 'active')->count(),
                'trials' => $subs->where('status', 'trial')->count(),
                'revenue_month' => (int) \App\Models\Payment::where('plan_id', $plan->id)->where('status', 'captured')
                    ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount'),
            ];
        }
        // Plan distribution (for horizontal bars)
        $totalActiveAcrossPlans = max(1, collect($planPerformance)->sum('active'));

        // Analytics series
        $orgGrowthRaw = \App\Models\Organization::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, COUNT(*) as total')
            ->groupBy('ym')->orderBy('ym')->take(6)->get();
        $orgGrowthLabels = $orgGrowthRaw->pluck('ym')->map(function ($ym) {
            return \Carbon\Carbon::createFromFormat('Y-m', $ym)->format('M Y');
        });
        $orgGrowthValues = $orgGrowthRaw->pluck('total');

        $revenueRaw = \App\Models\Payment::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, SUM(amount) as total')
            ->where('status', 'captured')->groupBy('ym')->orderBy('ym')->take(6)->get();
        $revenueLabels = $revenueRaw->pluck('ym')->map(function ($ym) {
            return \Carbon\Carbon::createFromFormat('Y-m', $ym)->format('M Y');
        });
        $revenueValues = $revenueRaw->pluck('total');

        // Platform activity timeline
        $platformActivity = collect();
        foreach ($recentOrganizations as $org) {
            $platformActivity->push([
                'time' => $org->created_at,
                'icon' => 'building',
                'message' => 'New organization registered: ' . $org->name,
            ]);
        }
        foreach ($recentPayments as $pay) {
            $platformActivity->push([
                'time' => $pay->created_at,
                'icon' => 'credit-card',
                'message' => 'Payment received from ' . ($pay->organization->name ?? 'Organization') . ' for ' . ($pay->plan->name ?? 'Plan'),
            ]);
        }
        foreach ($recentBroadcasts as $bc) {
            $platformActivity->push([
                'time' => $bc->created_at,
                'icon' => 'send',
                'message' => 'Broadcast campaign sent by ' . ($bc->organization->name ?? 'Organization'),
            ]);
        }
        $platformActivity = $platformActivity->sortByDesc('time')->take(10)->values();
    }
@endphp

<div class="dashboard-page">
    {{-- Row 1: Metric cards --}}
    <div class="dashboard-row row">
        @if($isSuperAdmin)
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--blue">
                    <div class="metric-icon-wrap"><i data-feather="building"></i></div>
                    <div class="metric-value">{{ $totalOrgs }}</div>
                    <div class="metric-label">Total Organizations</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--cyan">
                    <div class="metric-icon-wrap"><i data-feather="users"></i></div>
                    <div class="metric-value">{{ $totalUsers }}</div>
                    <div class="metric-label">Total Users</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--green">
                    <div class="metric-icon-wrap"><i data-feather="credit-card"></i></div>
                    <div class="metric-value">{{ $activeSubscriptions }}</div>
                    <div class="metric-label">Active Subscriptions</div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--indigo">
                    <div class="metric-icon-wrap"><i data-feather="trending-up"></i></div>
                    <div class="metric-value">₹{{ number_format($monthlyRevenue) }}</div>
                    <div class="metric-label">Monthly Revenue</div>
                </div>
            </div>
        @else
            <div class="col-xl col-lg-4 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--blue">
                    <div class="metric-icon-wrap"><i data-feather="users"></i></div>
                    <div class="metric-value">{{ $totalLeads }}</div>
                    <div class="metric-label">Total Leads</div>
                </div>
            </div>
            <div class="col-xl col-lg-4 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--cyan">
                    <div class="metric-icon-wrap"><i data-feather="user-plus"></i></div>
                    <div class="metric-value">{{ $newLeadsToday }}</div>
                    <div class="metric-label">New Leads Today</div>
                </div>
            </div>
            <div class="col-xl col-lg-4 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--amber">
                    <div class="metric-icon-wrap"><i data-feather="clock"></i></div>
                    <div class="metric-value">{{ $pendingFollowUps }}</div>
                    <div class="metric-label">Pending Follow-ups</div>
                </div>
            </div>
            <div class="col-xl col-lg-4 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--green">
                    <div class="metric-icon-wrap"><i data-feather="check-circle"></i></div>
                    <div class="metric-value">{{ $dealsClosed }}</div>
                    <div class="metric-label">Deals Closed</div>
                </div>
            </div>
            <div class="col-xl col-lg-4 col-md-6 mb-4">
                <div class="dashboard-metric-card metric--indigo">
                    <div class="metric-icon-wrap"><i data-feather="percent"></i></div>
                    <div class="metric-value">{{ $conversionRate }}%</div>
                    <div class="metric-label">Conversion Rate</div>
                </div>
            </div>
        @endif
    </div>

    @if($isSuperAdmin)
        {{-- Super Admin: Analytics charts --}}
        <div class="dashboard-row row">
            <div class="col-lg-8 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Organizations Growth</h4>
                    </div>
                    <div class="card-body">
                        <div id="org-growth-chart" style="min-height: 260px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Revenue (Last Periods)</h4>
                    </div>
                    <div class="card-body">
                        <div id="revenue-chart" style="min-height: 260px;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Super Admin: Row 3 — Activity timeline + Plan distribution --}}
        <div class="dashboard-row row">
            <div class="col-lg-8 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Platform Activity</h4>
                    </div>
                    <div class="card-body">
                        @if($platformActivity->isEmpty())
                            <p class="dashboard-empty mb-0">No recent activity yet.</p>
                        @else
                            @foreach($platformActivity as $event)
                                <div class="activity-item">
                                    <span class="activity-dot"></span>
                                    <div>
                                        <span class="activity-title">
                                            <i data-feather="{{ $event['icon'] }}" style="width:16px;height:16px;margin-right:4px;"></i>
                                            {{ $event['message'] }}
                                        </span>
                                    </div>
                                    <span class="activity-time">{{ $event['time']->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Plan Distribution</h4>
                    </div>
                    <div class="card-body">
                        @php
                            $totalActive = $totalActiveAcrossPlans;
                        @endphp
                        @forelse($planPerformance as $pp)
                            @php
                                $pct = $totalActive ? round($pp['active'] / $totalActive * 100) : 0;
                            @endphp
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="font-weight-600">{{ $pp['plan']->name }}</span>
                                    <span class="text-muted small">{{ $pct }}%</span>
                                </div>
                                <div class="stage-bar">
                                    <div class="stage-bar-fill" style="width: {{ $pct }}%; background: linear-gradient(90deg, #0EA5E9, #38BDF8);"></div>
                                </div>
                            </div>
                        @empty
                            <p class="dashboard-empty mb-0">No active plans.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Organization: Row 2 — Recent Leads + Follow-up widget --}}
        <div class="dashboard-row row">
            <div class="col-lg-8 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
                        <h4>Recent Leads</h4>
                        <a href="{{ route('leads.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="recent-leads-table" class="table table-striped crm-datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Lead Name</th>
                                        <th>Phone</th>
                                        <th>Stage</th>
                                        <th>Last Activity</th>
                                        <th>Next Follow-up</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentLeads as $lead)
                                        <tr>
                                            <td>{{ $lead->name ?? '—' }}</td>
                                            <td>{{ $lead->phone }}</td>
                                            <td><span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $lead->stage)) }}</span></td>
                                            <td>{{ $lead->updated_at->format('M d, Y H:i') }}</td>
                                            <td>
                                                @if(isset($nextFollowUpMap[$lead->id]))
                                                    {{ $nextFollowUpMap[$lead->id]->due_at->format('M d, H:i') }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td><a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted crm-datatable-empty">No leads yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Follow-up Management</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="small text-uppercase text-muted mb-2">Today's Follow-ups</h5>
                        @if($todayFollowUps->isEmpty())
                            <p class="small text-muted mb-3">None scheduled.</p>
                        @else
                            @foreach($todayFollowUps->take(3) as $fu)
                                <div class="followup-item">
                                    <div>
                                        <div class="lead-name">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                                        <div class="reminder-time">{{ $fu->due_at->format('H:i') }}</div>
                                    </div>
                                    <a href="{{ route('follow-ups.index') }}" class="btn btn-sm btn-primary btn-quick">Open</a>
                                </div>
                            @endforeach
                            @if($todayFollowUps->count() > 3)
                                <a href="{{ route('follow-ups.index') }}" class="small">View all {{ $todayFollowUps->count() }}</a>
                            @endif
                        @endif

                        <h5 class="small text-uppercase text-muted mb-2 mt-3">Upcoming</h5>
                        @if($upcomingFollowUps->isEmpty())
                            <p class="small text-muted mb-3">No upcoming.</p>
                        @else
                            @foreach($upcomingFollowUps->take(3) as $fu)
                                <div class="followup-item">
                                    <div>
                                        <div class="lead-name">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                                        <div class="reminder-time">{{ $fu->due_at->format('M d, H:i') }}</div>
                                    </div>
                                    <a href="{{ route('follow-ups.index') }}" class="btn btn-sm btn-outline-primary btn-quick">Open</a>
                                </div>
                            @endforeach
                        @endif

                        <h5 class="small text-uppercase text-muted mb-2 mt-3">Overdue</h5>
                        @if($overdueFollowUps->isEmpty())
                            <p class="small text-muted mb-0">None.</p>
                        @else
                            @foreach($overdueFollowUps->take(3) as $fu)
                                <div class="followup-item">
                                    <div>
                                        <div class="lead-name">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                                        <div class="reminder-time text-danger">{{ $fu->due_at->format('M d, H:i') }}</div>
                                    </div>
                                    <a href="{{ route('follow-ups.index') }}" class="btn btn-sm btn-outline-danger btn-quick">Open</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Row 3 — Pipeline summary + Activity timeline --}}
        <div class="dashboard-row row">
            <div class="col-lg-6 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Sales Pipeline Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($pipelineStages as $stage)
                                <div class="col-6 col-md-4 mb-3">
                                    <div class="pipeline-stage-card">
                                        <div class="stage-name">{{ $pipelineLabels[$stage] }}</div>
                                        <div class="stage-count">{{ $pipelineCounts[$stage] }}</div>
                                        <div class="stage-bar">
                                            <div class="stage-bar-fill" style="width: {{ $pipelineMax ? round(100 * $pipelineCounts[$stage] / $pipelineMax) : 0 }}%; background: linear-gradient(90deg, #0EA5E9, #38BDF8);"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header">
                        <h4>Recent Activity</h4>
                    </div>
                    <div class="card-body p-0">
                        @if($activityItems->isEmpty())
                            <p class="dashboard-empty mb-0">No recent activity yet.</p>
                        @else
                            @foreach($activityItems as $item)
                                <div class="activity-item">
                                    <span class="activity-dot"></span>
                                    <div>
                                        <span class="activity-title">{{ $item['title'] }}</span>
                                        <span class="activity-meta"> — {{ $item['meta'] }}</span>
                                    </div>
                                    <span class="activity-time">{{ $item['time']->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($isSuperAdmin)
        {{-- Super Admin: Recent Leads table (compact) --}}
        <div class="dashboard-row row">
            <div class="col-12 mb-4">
                <div class="dashboard-card card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap">
                        <h4>Recent Leads</h4>
                        <a href="{{ route('leads.index') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="recent-leads-table" class="table table-striped crm-datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Stage</th>
                                        <th>Organization</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentLeads as $lead)
                                        <tr>
                                            <td>{{ $lead->name ?? '—' }}</td>
                                            <td>{{ $lead->phone }}</td>
                                            <td><span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $lead->stage)) }}</span></td>
                                            <td>{{ $lead->organization->name ?? '—' }}</td>
                                            <td>{{ $lead->updated_at->format('M d, Y') }}</td>
                                            <td><a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted crm-datatable-empty">No leads yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
$(function () {
    if (typeof feather !== 'undefined') feather.replace();
    var $table = $('#recent-leads-table');
    if ($table.length && $table.find('tbody tr').length && !$table.find('tbody tr').first().find('.crm-datatable-empty').length) {
        $table.DataTable({
            order: [[$table.find('thead th').length - 2, 'desc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
            searching: true,
            lengthChange: true,
            columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
        });
    }
});

@if($isSuperAdmin)
// ApexCharts analytics (super admin only)
if (typeof ApexCharts !== 'undefined') {
    var orgOptions = {
        chart: {
            type: 'area',
            height: 260,
            toolbar: { show: false },
            fontFamily: 'Nunito, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", sans-serif'
        },
        colors: ['#0EA5E9'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.4,
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100]
            }
        },
        series: [{
            name: 'Organizations',
            data: @json($orgGrowthValues)
        }],
        xaxis: {
            categories: @json($orgGrowthLabels),
            labels: { style: { colors: '#64748b' } }
        },
        yaxis: {
            labels: { style: { colors: '#64748b' } },
            min: 0,
            forceNiceScale: true
        },
        grid: { borderColor: '#e2e8f0' }
    };
    var orgChartEl = document.querySelector('#org-growth-chart');
    if (orgChartEl) new ApexCharts(orgChartEl, orgOptions).render();

    var revenueOptions = {
        chart: {
            type: 'bar',
            height: 260,
            toolbar: { show: false },
            fontFamily: 'Nunito, system-ui, -apple-system, BlinkMacSystemFont, \"Segoe UI\", sans-serif'
        },
        colors: ['#38BDF8'],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: '55%'
            }
        },
        dataLabels: { enabled: false },
        series: [{
            name: 'Revenue (₹)',
            data: @json($revenueValues)
        }],
        xaxis: {
            categories: @json($revenueLabels),
            labels: { style: { colors: '#64748b' } }
        },
        yaxis: {
            labels: { style: { colors: '#64748b' } },
            min: 0,
            forceNiceScale: true
        },
        grid: { borderColor: '#e2e8f0' }
    };
    var revenueChartEl = document.querySelector('#revenue-chart');
    if (revenueChartEl) new ApexCharts(revenueChartEl, revenueOptions).render();
}
@endif
</script>
@if($isSuperAdmin)
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endif
@endpush
@endsection
