@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Courses Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Types</th>
                <th>Groups</th>
                <th>Subjects</th>
                <th>Title</th>
                <th>Video Link</th>
                <th>PDF</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($pdf as $course)
            <tr>
                <td>{{ $course->question }}</td>
                <td>{{ $course->group }}</td>
                <td>{{ $course->subject }}</td>
                <td>{{ $course->title }}</td>
                <td>
                    <a href="{{asset($course->thumbnail)}}" target="_blank">
                        <img src="{{ asset($course->thumbnail) }}" width="80" alt="{{ $course->title }}">
                    </a>
                </td>
                <td><a href="{{ asset($course->pdf) }}" target="_blank">Download PDF</a></td>
                <td>
                    <a href="{{ route('honors.edit', $course->id) }}" class="btn btn-sm btn-primary">Edit</a>

                    <form id="delete-form-{{ $course->id }}" action="{{ route('honors.delete', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $course->id }})">Delete</button>
                    </form>
                </td>
                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this item? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <script>
        let deleteFormId = null;

        function confirmDelete(id) {
            deleteFormId = 'delete-form-' + id;
            let modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();

            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.getElementById(deleteFormId).submit();
            }
        }
    </script>

@endsection
