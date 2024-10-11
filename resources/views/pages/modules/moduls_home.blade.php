
@extends('layouts.common_component')

@section('content')
    <div class="container">
        <div class="card">
            <div class="row">
                <div class="card-body">
                   @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'ACADEMIC_HEAD' )
                    <button type="button" id="addmodules" class="btn btn-outline-primary">Add Modules</button>
                    @endif
                    <a type="button" href="{{route('course_home')}}" class="btn btn-outline-danger">Close</a>

                    <div class="row">
                    <div class="col-md-12">
                        <h2>{{$corename}}&nbsp;Modules List</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Semester</th>
                                    <th>Credit</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($modules as $modul)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $modul->code }}</td>
                                    <td>{{ $modul->name }}</td>
                                    <td>{{ $modul->semester }}</td>
                                    <td>{{ $modul->credit }}</td>
                                    <td>
                                        @if($modul->status == 'draft')
                                        <span class="badge bg-warning ">{{$modul->status}}</span>
                                        @elseif($modul->status == 'publish')
                                        <span class="badge bg-success ">{{$modul->status}}</span>
                                        @endif
                                    </td>
                                    <td>

                                        @if (Auth::user()->role == 'ADMIN' || (Auth::user()->role == 'ACADEMIC_HEAD' && $modul->hours_diff <= 6))
                                        <button id="editmodules" onclick="editmodules({{$modul}})" class="btn btn-sm btn-warning" data-techerId="{{$modul->id}}" data-name="{{$modul->name}}" data-email="{{$modul->email}}">Edit</button>
                                        @endif
                                        <form action="{{ route('delete_modules',  ['id' => $modul->id,'corseId'=>$modul->course_id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @if (Auth::user()->role == 'ADMIN' || (Auth::user()->role == 'ACADEMIC_HEAD' && $modul->hours_diff <= 6))
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            @endif
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


    <!-- add modules model -->
    <div class="modal" id="modulesModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Module</h5>
            </div>
            <form action="{{route('new_modules')}}" method="POST">
                <div class="modal-body">
                    
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="code" readonly value="{{$code}}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester" class="form-label">Semester</label>
                            <select class="form-select" id="semester" name="semester" required>
                                <option value="">Select Semester</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mtype" class="form-label">Module Type</label>
                            <select class="form-select" id="mtype" name="mtype" required>
                                <option value="">Select Module Type</option>
                                <option value="Mandatory">Mandatory</option>
                                <option value="Elective">Elective</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="credit" class="form-label">Credit</label>
                            <input type="text" class="form-control" id="credit" name="credit" required>
                        </div>

                        <div class="mb-3">
                            <label for="descr" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="descr" name="descr" required></textarea>
                        </div>
                        <input type="text" class="form-control" id="modulesId" name="modulesId" hidden>
                        <input type="text" class="form-control" id="corseId" name="corseId" value="{{$corseId}}" hidden>
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
        // add modules modal open
        document.getElementById('addmodules').onclick = function() {
            document.getElementById('modulesModel').style.display = 'block';
        }

        

        // close modal
        document.getElementById('coseModel').onclick = function() {
            document.getElementById('modulesModel').style.display = 'none';
            document.getElementById('name').value = '';
            document.getElementById('code').value = '';
            document.getElementById('semester').value = '';
            document.getElementById('mtype').value = '';
            document.getElementById('credit').value = '';
            document.getElementById('descr').value = '';
            document.getElementById('modulesId').value = '';
            document.getElementById('corseId').value = '';

        }

     let type = "{{$type}}";
     if(type == 'success'){
        alert('modules added successfully');
     }
    });
   
   // Edit modules modal open
   function editmodules(data) {    
    document.getElementById('modulesModel').style.display = 'block';
    document.getElementById('name').value = data.name;
    document.getElementById('code').value = data.code;
    document.getElementById('semester').value = data.semester;
    document.getElementById('mtype').value = data.type;
    document.getElementById('credit').value = data.credit;
    document.getElementById('descr').value = data.description;
    document.getElementById('modulesId').value = data.id;
    document.getElementById('corseId').value = data.course_id;

        }
</script>
