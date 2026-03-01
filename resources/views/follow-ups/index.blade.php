@extends('layouts.app')
@section('title', 'Follow-ups')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Follow-ups</h4>
                <div class="card-header-action">
                    <a href="{{ route('follow-ups.create') }}" class="btn btn-primary">Add Follow-up</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr><th>Lead</th><th>Due at</th><th>Status</th><th>Notes</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            @foreach($followUps as $fu)
                            <tr>
                                <td><a href="{{ route('leads.show', $fu->lead) }}">{{ $fu->lead->name ?? $fu->lead->phone }}</a></td>
                                <td>{{ $fu->due_at->format('M d, Y H:i') }}</td>
                                <td><span class="badge badge-{{ $fu->status === 'done' ? 'success' : ($fu->status === 'missed' ? 'danger' : 'warning') }}">{{ $fu->status }}</span></td>
                                <td>{{ $fu->notes ? \Illuminate\Support\Str::limit($fu->notes, 30) : '—' }}</td>
                                <td>
                                    <form action="{{ route('follow-ups.update-status', $fu) }}" method="POST" class="d-inline">@csrf @method('PUT')<input type="hidden" name="status" value="done"><button type="submit" class="btn btn-sm btn-success">Done</button></form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($followUps->hasPages())<div class="card-footer">{{ $followUps->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
