@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Organizations</h5>
                                <h2 class="mb-3 font-18">{{ $stats['organizations'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img"><img src="{{ asset('assets/img/banner/1.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Leads</h5>
                                <h2 class="mb-3 font-18">{{ $stats['leads'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img"><img src="{{ asset('assets/img/banner/2.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Active Subscriptions</h5>
                                <h2 class="mb-3 font-18">{{ $stats['subscriptions'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img"><img src="{{ asset('assets/img/banner/3.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Broadcasts</h5>
                                <h2 class="mb-3 font-18">{{ $stats['broadcasts'] }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img"><img src="{{ asset('assets/img/banner/4.png') }}" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Recent Leads</h4>
                <div class="card-header-action">
                    <a href="{{ route('leads.index') }}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Phone</th>
                                <th>Name</th>
                                <th>Stage</th>
                                @if(auth()->user()->hasRole('super_admin'))<th>Organization</th>@endif
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
                                @if(auth()->user()->hasRole('super_admin'))<td>{{ $lead->organization->name ?? '—' }}</td>@endif
                                <td>{{ $lead->updated_at->format('M d, Y') }}</td>
                                <td><a href="{{ route('leads.show', $lead) }}" class="btn btn-sm btn-outline-primary">View</a></td>
                            </tr>
                            @empty
                            <tr><td colspan="{{ auth()->user()->hasRole('super_admin') ? 6 : 5 }}" class="text-center text-muted">No leads yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
