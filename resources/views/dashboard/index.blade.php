@extends('layouts.app')

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
        $orgId = auth()->user()->hasRole('super_admin') ? null : auth()->user()->organization_id;
        $leadBaseQuery = \App\Models\Lead::query();
        if ($orgId) {
            $leadBaseQuery->where('organization_id', $orgId);
        }
        $totalLeads = $stats['leads'] ?? (clone $leadBaseQuery)->count();
        $newLeadsToday = (clone $leadBaseQuery)->whereDate('created_at', now()->toDateString())->count();
        $dealsClosed = (clone $leadBaseQuery)->where('stage', 'closed_won')->count();
        $conversionRate = $totalLeads > 0 ? round(($dealsClosed / $totalLeads) * 100, 1) : 0;
        $pendingFollowUps = \App\Models\FollowUp::when($orgId, function ($q) use ($orgId) {
            return $q->where('organization_id', $orgId);
        })->where('status', 'pending')->count();

        $recentFollowUps = \App\Models\FollowUp::with('lead')
            ->when($orgId, function ($q) use ($orgId) {
                return $q->where('organization_id', $orgId);
            })
            ->latest()
            ->take(6)
            ->get();

        $upcomingFollowUps = \App\Models\FollowUp::with('lead')
            ->when($orgId, function ($q) use ($orgId) {
                return $q->where('organization_id', $orgId);
            })
            ->where('status', 'pending')
            ->where('due_at', '>=', now())
            ->orderBy('due_at')
            ->take(6)
            ->get();

        $activityItems = collect();
        foreach ($recentLeads->take(6) as $lead) {
            $activityItems->push([
                'time' => $lead->created_at,
                'title' => 'New lead added',
                'meta' => $lead->name ?? $lead->phone,
            ]);
            if ($lead->updated_at && $lead->updated_at->ne($lead->created_at)) {
                $activityItems->push([
                    'time' => $lead->updated_at,
                    'title' => 'Pipeline stage updated',
                    'meta' => ucfirst(str_replace('_', ' ', $lead->stage)),
                ]);
            }
        }
        foreach ($recentFollowUps as $followUp) {
            $activityItems->push([
                'time' => $followUp->created_at,
                'title' => 'Follow-up scheduled',
                'meta' => ($followUp->lead->name ?? $followUp->lead->phone ?? 'Lead') . ' • ' . $followUp->due_at->format('M d, H:i'),
            ]);
        }
        $activityItems = $activityItems->sortByDesc('time')->take(6);
    @endphp

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="metric-card metric-card--blue">
                        <div class="metric-icon"><i data-feather="users"></i></div>
                        <div>
                            <div class="metric-label">Total Leads</div>
                            <div class="metric-value">{{ $totalLeads }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="metric-card metric-card--cyan">
                        <div class="metric-icon"><i data-feather="clock"></i></div>
                        <div>
                            <div class="metric-label">Pending Follow-ups</div>
                            <div class="metric-value">{{ $pendingFollowUps }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="metric-card metric-card--green">
                        <div class="metric-icon"><i data-feather="check-circle"></i></div>
                        <div>
                            <div class="metric-label">Deals Closed</div>
                            <div class="metric-value">{{ $dealsClosed }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="metric-card metric-card--indigo">
                        <div class="metric-icon"><i data-feather="percent"></i></div>
                        <div>
                            <div class="metric-label">Conversion Rate</div>
                            <div class="metric-value">{{ $conversionRate }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Leads</h4>
                    <div class="card-header-action">
                        <a href="{{ route('leads.index') }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="recent-leads-table" class="table table-striped crm-datatable">
                            <thead>
                                <tr>
                                    <th>Phone</th>
                                    <th>Name</th>
                                    <th>Stage</th>
                                    @if(auth()->user()->hasRole('super_admin'))
                                    <th>Organization</th>@endif
                                    <th>Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentLeads as $lead)
                                    <tr>
                                        <td>{{ $lead->phone }}</td>
                                        <td>{{ $lead->name ?? '—' }}</td>
                                        <td><span class="badge badge-info">{{ $lead->stage }}</span></td>
                                        @if(auth()->user()->hasRole('super_admin'))
                                        <td>{{ $lead->organization->name ?? '—' }}</td>@endif
                                        <td>{{ $lead->updated_at->format('M d, Y') }}</td>
                                        <td><a href="{{ route('leads.show', $lead) }}"
                                                class="btn btn-sm btn-outline-primary">View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->hasRole('super_admin') ? 6 : 5 }}"
                                            class="text-center text-muted crm-datatable-empty">No leads yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Upcoming Follow-ups</h4>
                </div>
                <div class="card-body">
                    @if($upcomingFollowUps->isEmpty())
                        <p class="text-muted mb-0">No upcoming follow-ups.</p>
                    @else
                        <ul class="list-unstyled mb-0">
                            @foreach($upcomingFollowUps as $fu)
                                <li class="mb-3">
                                    <div class="font-weight-600">{{ $fu->lead->name ?? $fu->lead->phone }}</div>
                                    <div class="text-muted small">{{ $fu->due_at->format('M d, H:i') }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Recent Activity</h4>
                </div>
                <div class="card-body">
                    @if($activityItems->isEmpty())
                        <p class="text-muted mb-0">No recent activity yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Event</th>
                                        <th>Details</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activityItems as $item)
                                        <tr>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['meta'] }}</td>
                                            <td>{{ $item['time']->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {
                if ($('#recent-leads-table tbody tr').length && !$('#recent-leads-table tbody tr').first().find('.crm-datatable-empty').length) {
                    $('#recent-leads-table').DataTable({
                        order: [[-2, 'desc']],
                        pageLength: 10,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        searching: true,
                        lengthChange: true,
                        columnDefs: [{ orderable: false, searchable: false, targets: -1 }]
                    });
                }
            });
        </script>
    @endpush
@endsection
