@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                    <h4 class="page-title">Device</h4>
                    <div class="">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">{{config('app.name')}}</a></li>
                            <li class="breadcrumb-item"><a href="#">Device</a></li>
                            <li class="breadcrumb-item active">Device ID List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 mb-3">
            <div class="col-md-6">
                @if(isset($search) && $search != '')
                    <p class="mb-0">
                        Showing <strong>{{ $totalResults }}</strong> result(s) for "<strong>{{ $search }}</strong>"
                    </p>
                @else
                    <p class="mb-0">
                        Total Devices: <strong>{{ $totalResults ?? $device->count() }}</strong>
                    </p>
                @endif
            </div>

            <div class="col-md-4 d-flex justify-content-end ms-auto">
                <form action="{{ route('device.search') }}" method="GET" class="d-flex w-100" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control form-control-sm me-2"
                           placeholder="Search..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>
            </div>
        </div>


        <div class="table-responsive mt-4">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Device Id</th>
                    <th>Device Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Visited Count</th>
                    <th>Created At</th>
                    <th>Levels</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @forelse($device as $devices)
                    <tr>
                        <form action="{{route('updatedeviceid',['device_id'=>$devices->id])}}" method="POST">
                            @csrf
                            <td>{{$devices->id}}</td>
                            <td>{{$devices->device_id}}</td>
                            <td>{{$devices->device_name}}</td>
                            <td>
                                <input type="email" name="email" class="form-control" value="{{old('email',$devices->email)}}">
                            </td>
                            <td>
                                <input type="text" name="password" class="form-control" value="{{old('password',$devices->plain_password)}}">
                            </td>
                            <td>{{$devices->login_count}}</td>
                            <td>{{$devices->created_at}}</td>

                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ssc" value="1" {{ old('ssc', $devices->ssc) ? 'checked' : '' }}>
                                    <label class="form-check-label">SSC</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hsc" value="1" {{ old('hsc', $devices->hsc) ? 'checked' : '' }}>
                                    <label class="form-check-label">HSC</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="honors" value="1" {{ old('honors', $devices->honors) ? 'checked' : '' }}>
                                    <label class="form-check-label">Honors</label>
                                </div>
                            </td>

                            <td>
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </td>
                        </form>

                        <td>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $devices->id }}">
                                Delete
                            </button>

                            <div class="modal fade" id="deleteModal{{ $devices->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $devices->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $devices->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete device <strong>{{ $devices->device_name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{route('delete.device',['id'=>$devices->id])}}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Devices Found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
