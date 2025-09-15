@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Class</h2>
        <form action="{{route('hsc.class.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->


            <div class="mb-3">
                <label for="title" class="form-label">Class Name</label>
                <input type="text" class="form-control" id="title" name="class_name" placeholder="Enter class name" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-5">

        <h2 class="mb-4">Class Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Subject</th>

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($subjects as $course)
                <tr>
                    <td>
                        <input type="text" name="class_name" value="{{ $course->class_name }}" class="form-control" form="update-form-{{ $course->id }}">
                    </td>


                    <td>
                        <form id="update-form-{{ $course->id }}" action="{{route('hsc.class.update',$course->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary">Update</button>
                        </form>

                        <form id="delete-form-{{ $course->id }}" action="{{ route('hsc.class.delete', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $course->id }})">Delete</button>
                        </form>
                    </td>

                    <!-- Modal -->
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
        let deleteCourseId = null;

        function confirmDelete(courseId) {
            deleteCourseId = courseId;
            let modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (deleteCourseId) {
                document.getElementById('delete-form-' + deleteCourseId).submit();
            }
        });
    </script>



@endsection

