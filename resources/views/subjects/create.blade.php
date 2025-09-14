@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Add Subject</h2>
        <form action="{{route('subjects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->

            <div class="mb-3">
                <label for="class" class="form-label">Select Class</label>
                <select class="form-select" id="class" name="class" required>
                    <option value="" selected disabled>-- Select Class --</option>
                    <option value="ssc">SSC</option>
                    <option value="hsc">HSC</option>
                    <option value="honors">Honors</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="class" class="form-label">Select Group</label>
                <select class="form-select" id="class" name="group">
                    <option value="" selected disabled>-- Select Group --</option>
                    <option value="science">Science</option>
                    <option value="commerce">Commerce</option>
                    <option value="arts">Arts</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Subject Title</label>
                <input type="text" class="form-control" id="title" name="subject" placeholder="Enter subject name" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-5">

        <h2 class="mb-4">Subjects Table</h2>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
            <tr>
                <th>Subject</th>
                <th>Class</th>
                <th>Group</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->


            <!-- Add more rows dynamically from database -->

            @foreach($subjects as $course)
                <tr>
                    <td>
                        <input type="text" name="subject" value="{{ $course->subject }}" class="form-control" form="update-form-{{ $course->id }}">
                    </td>
                    <td>
                        <select class="form-select" id="class" name="class" required form="update-form-{{ $course->id }}">
                            <option value="" selected disabled>-- Select Class --</option>
                            <option value="ssc" {{ $course->class == 'ssc' ? 'selected' : '' }}>SSC</option>
                            <option value="hsc" {{ $course->class == 'hsc' ? 'selected' : '' }}>HSC</option>
                            <option value="honors" {{ $course->class == 'honors' ? 'selected' : '' }}>Honors</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-select" id="class" name="group" required form="update-form-{{ $course->id }}">
                            <option value="" selected disabled>-- Select Group --</option>
                            <option value="science" {{ $course->class == 'science' ? 'selected' : '' }}>Science</option>
                            <option value="commerce" {{ $course->class == 'commerce' ? 'selected' : '' }}>Commerce</option>
                            <option value="arts" {{ $course->class == 'arts' ? 'selected' : '' }}>Arts</option>
                        </select>
                    </td>
                    <td>
                        <form id="update-form-{{ $course->id }}" action="{{route('subjects.update',$course->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-primary">Update</button>
                        </form>

                        <form id="delete-form-{{ $course->id }}" action="{{ route('subjects.destroy', $course->id) }}" method="POST" style="display:inline;">
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
                                    <p id="relatedDataText">Loading...</p>
                                    <p>Are you sure you want to delete this subject? This action cannot be undone.</p>
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

            // Fetch related titles using AJAX
            fetch(`/subjects/${id}/related-data`)
                .then(response => response.json())
                .then(data => {
                    let text = '';
                    if (data.titles.length > 0) {
                        text += `This subject is used in the following PDFs:<br><ul>`;
                        data.titles.forEach(title => {
                            text += `<li>${title}</li>`;
                        });
                        text += `</ul>`;
                    } else {
                        text += "No related records found.<br>";
                    }
                    document.getElementById('relatedDataText').innerHTML = text;
                });

            // Show the modal
            let modal = new bootstrap.Modal(document.getElementById('confirmModal'));
            modal.show();

            // On confirm, submit the delete form
            document.getElementById('confirmDeleteBtn').onclick = function() {
                document.getElementById(deleteFormId).submit();
            }
        }
    </script>



@endsection
