@extends('layouts.app')
@section('title', 'WhatsApp API Settings')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>WhatsApp API Configuration</h4>
                    <div class="card-header-action">
                        <a href="{{ route('whatsapp-settings.create') }}" class="btn btn-primary"><i
                                data-feather="plus"></i> Add Configuration</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <p class="text-muted">System-wide WhatsApp Business API credentials. Only one configuration can be
                        active at a time.</p>
                    <div class="table-responsive">
                        <table id="whatsapp-settings-table" class="table table-striped crm-datatable">
                            <thead>
                                <tr>
                                    <th>Provider</th>
                                    <th>App ID</th>
                                    <th>Phone Number ID</th>
                                    <th>Status</th>
                                    <th>Last updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($settings as $s)
                                    <tr>
                                        <td>{{ ucfirst($s->provider) }}</td>
                                        <td>
                                            <code class="copyable-app-id"
                                                data-value="{{ $s->app_id }}">{{ $s->app_id ?? '—' }}</code>
                                            <button type="button" class="btn btn-sm btn-outline-secondary ml-1 copy-btn"
                                                data-copy="{{ $s->app_id }}" title="Copy">Copy</button>
                                        </td>
                                        <td><code>{{ $s->phone_number_id ?? '—' }}</code></td>
                                        <td>
                                            @if($s->status === 'active')
                                                <span class="badge badge-success">Connected</span>
                                            @else
                                                <span class="badge badge-danger">Not Connected</span>
                                            @endif
                                        </td>
                                        <td>{{ $s->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="crm-btn-group">
                                                <a href="{{ route('whatsapp-settings.edit', $s) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('whatsapp-settings.test', $s) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-info">Test connection</button>
                                                </form>
                                                <form action="{{ route('whatsapp-settings.destroy', $s) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Remove this configuration?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted crm-datatable-empty">No WhatsApp
                                            configuration yet. <a href="{{ route('whatsapp-settings.create') }}">Add one</a>.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            document.querySelectorAll('.copy-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var value = this.getAttribute('data-copy');
                    if (value && navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(value).then(function () {
                            var t = btn.textContent; btn.textContent = 'Copied!';
                            setTimeout(function () { btn.textContent = 'Copy'; }, 1500);
                        });
                    }
                });
            });

            $(function () {
                if ($('#whatsapp-settings-table tbody tr').length && !$('#whatsapp-settings-table tbody tr').first().find('.crm-datatable-empty').length) {
                    $('#whatsapp-settings-table').DataTable({
                        order: [[0, 'asc']],
                        pageLength: 25,
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