@extends('layouts.common_component')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="card-body">
                   
                    <button type="button" id="addteacher" class="btn btn-outline-primary">Add teacher</button>
                    <a type="button" href="{{route('dashboard')}}" class="btn btn-outline-danger">Close</a>

                    <div class="row">
                    <div class="col-md-12">
                        <h2>Teacher List</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>

                                        <button id="editTeacher" onclick="editTeacher(this)" class="btn btn-sm btn-warning" data-techerId="{{$teacher->id}}" data-name="{{$teacher->name}}" data-email="{{$teacher->email}}">Edit</button>
                                        <form action="{{ route('delete_teacher',  ['id' => $teacher->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- add teacher model -->
    <div class="modal" id="teacherModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Teacher</h5>
            </div>
            <form action="{{route('new_teacher')}}" method="POST">
                <div class="modal-body">
                    
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <input type="text" class="form-control" id="teacherId" name="teacherId" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="coseModel">Close</button>
                    <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // add teacher modal open
        document.getElementById('addteacher').onclick = function() {
            document.getElementById('teacherModel').style.display = 'block';
        }

        

        // close modal
        document.getElementById('coseModel').onclick = function() {
            document.getElementById('teacherModel').style.display = 'none';
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('teacherId').value = '';
        }

     let type = "{{$type}}";
     if(type == 'success'){
        alert('Teacher added successfully');
     }
    });
   
   // Edit teacher modal open
   function editTeacher(thisObj) {
    
    document.getElementById('teacherModel').style.display = 'block';
    document.getElementById('name').value = thisObj.getAttribute('data-name');
    document.getElementById('email').value = thisObj.getAttribute('data-email');
    document.getElementById('teacherId').value = thisObj.getAttribute('data-techerId');
        }
</script>