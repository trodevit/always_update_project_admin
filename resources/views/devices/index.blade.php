@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Page Header --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <h4 class="page-title mb-0">Device</h4>
                    <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill px-3">
                        ID List
                    </span>
                </div>
                <div>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">{{ config('app.name') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">Device</a></li>
                        <li class="breadcrumb-item active">Device ID List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Top Row: Stats + Search --}}
    <div class="row g-3 align-items-center mt-1">
        <div class="col-md-8">
            <div class="alert alert-light border d-flex align-items-center gap-3 mb-0">
                <i class="mdi mdi-devices fs-3 text-primary"></i>
                @if(isset($search) && $search !== '')
                    <div>
                        Showing <strong>{{ $totalResults }}</strong> result(s) for
                        “<strong class="text-dark">{{ $search }}</strong>”
                        <a href="{{ route('device.search') }}" class="ms-2 small text-decoration-underline">Clear</a>
                    </div>
                @else
                    <div>
                        Total Devices:
                        <strong>{{ $totalResults ?? (method_exists($device, 'count') ? $device->count() : collect($device)->count()) }}</strong>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4 ms-auto">
            <form action="{{ route('device.search') }}" method="GET" class="d-flex w-100" style="max-width: 420px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-body"><i class="mdi mdi-magnify"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Search by device, email, ID…"
                           value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('device.search') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card mt-4 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark position-sticky top-0" style="z-index:1">
                        <tr>
                            <th>#</th>
                            <th>Device ID</th>
                            <th>Device Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>
                                <span data-bs-toggle="tooltip" title="Total successful logins from this device">
                                    Visited <i class="mdi mdi-information-outline"></i>
                                </span>
                            </th>
                            <th>Created</th>
                            <th>Levels</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($device as $devices)
                        <tr class="border-top">
                            <form action="{{ route('updatedeviceid', ['device_id' => $devices->id]) }}" method="POST" class="w-100">
                                @csrf
                                <td class="text-muted fw-medium">{{ $devices->id }}</td>
                                <td class="font-monospace">
                                    <span class="me-2">{{ $devices->device_id }}</span>
                                    <!-- <button class="btn btn-light btn-xs border copy-btn" type="button"
                                            data-copy="{{ $devices->device_id }}" data-bs-toggle="tooltip" title="Copy">
                                        <i class="mdi mdi-content-copy"></i>
                                    </button> -->
                                </td>
                                <td class="fw-semibold">{{ $devices->device_name }}</td>

                                {{-- Email --}}
                                <td style="min-width: 260px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-body"><i class="mdi mdi-email-outline"></i></span>
                                        <input type="email" name="email" class="form-control"
                                               value="{{ old('email', $devices->email) }}"
                                               placeholder="user@example.com">
                                    </div>
                                </td>

                                {{-- Password always visible --}}
                                <td style="min-width: 220px;">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-body"><i class="mdi mdi-lock-outline"></i></span>
                                        <input type="text" name="password" class="form-control"
                                               value="{{ old('password', $devices->plain_password) }}">
                                    </div>
                                </td>

                                {{-- Login count --}}
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary border">{{ $devices->login_count }}</span>
                                </td>

                                {{-- Created at --}}
                                <td class="text-muted">
                                    {{ optional($devices->created_at)->format('d M Y, h:i A') }}
                                </td>

                                {{-- Levels --}}
                                <td style="min-width: 220px;">
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" name="ssc" value="1"
                                                   id="ssc-{{ $devices->id }}"
                                                   {{ old('ssc', $devices->ssc) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="ssc-{{ $devices->id }}">SSC</label>
                                        </div>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" name="hsc" value="1"
                                                   id="hsc-{{ $devices->id }}"
                                                   {{ old('hsc', $devices->hsc) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hsc-{{ $devices->id }}">HSC</label>
                                        </div>
                                        <div class="form-check form-switch m-0">
                                            <input class="form-check-input" type="checkbox" name="honors" value="1"
                                                   id="honors-{{ $devices->id }}"
                                                   {{ old('honors', $devices->honors) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="honors-{{ $devices->id }}">Honors</label>
                                        </div>
                                    </div>
                                </td>

                                {{-- Update --}}
                                <td class="text-center">
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-content-save-outline me-1"></i> Save
                                    </button>
                                </td>
                            </form>

                            {{-- Delete --}}
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $devices->id }}">
                                    <i class="mdi mdi-delete-outline me-1"></i> Delete
                                </button>

                                <div class="modal fade" id="deleteModal{{ $devices->id }}" tabindex="-1"
                                     aria-labelledby="deleteModalLabel{{ $devices->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $devices->id }}">
                                                    Confirm Deletion
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete device
                                                <strong>{{ $devices->device_name }}</strong> (ID: {{ $devices->id }})?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('delete.device', ['id' => $devices->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="mdi mdi-delete-forever-outline me-1"></i> Yes, Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <i class="mdi mdi-database-off fs-1 d-block mb-2 text-muted"></i>
                                <div class="text-muted">No Devices Found</div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($device, 'links'))
                <div class="p-3 border-top">
                    {{ $device->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.bootstrap) {
        const tooltipEls = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipEls.forEach(el => new window.bootstrap.Tooltip(el));
    }

    // Copy buttons
    document.addEventListener('click', (e) => {
        const copyBtn = e.target.closest('.copy-btn');
        if (!copyBtn) return;
        const text = copyBtn.getAttribute('data-copy') || '';
        navigator.clipboard.writeText(text);
    });
});
</script>
@endpush

@push('styles')
<style>
    .table thead th { vertical-align: middle; }
    .btn-xs { --bs-btn-padding-y: .125rem; --bs-btn-padding-x: .35rem; --bs-btn-font-size: .75rem; }
    .font-monospace { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; }
    .badge.border { border-width: 1px!important; }
</style>
@endpush
