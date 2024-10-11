
@extends('layouts.common_component')

@section('content')
    <div class="container">
        @if (Auth::user()->role == 'ADMIN' || Auth::user()->role == 'ACADEMIC_HEAD' )
        <button type="button" id="addCorese" class="btn btn-outline-primary">Add Corse</button>
        @endif
        <a type="button" href="{{route('dashboard')}}" class="btn btn-outline-danger">Close</a>
        <br>
        <br>

        @foreach($corses as $corse)
        <div class="card">
            <div class="card-body">
                <h3>{{$corse->facultyName}}</h3>
                <h5 class="card-title">
                {{$corse->name}} 
                @if($corse->status == 'draft')
                <span class="badge bg-warning ">{{$corse->status}}</span>
                @elseif($corse->status == 'publish')
                <span class="badge bg-success ">{{$corse->status}}</span>
                @endif
                </h5>
                <p class="card-text">{{$corse->seo_url}}</p>
                <a href="{{route('module_home',['corseId' => $corse->id])}}" class="btn btn-primary">Go To Corse</a>
                @if (Auth::user()->role == 'ADMIN' || (Auth::user()->role == 'ACADEMIC_HEAD' && $corse->hours_diff <= 6))
                    <button id="editTeacher" onclick="editTeacher({{$corse}})" class="btn btn-warning">Edit</button>
                    <form action="{{route('delete_course',['id'=>$corse->id])}}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
        <br>
        @endforeach
       

    </div>

    <!-- add Corses model -->
    <div class="modal" id="corseModel" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Corse</h5>
            </div>
            <form action="{{route('new_course')}}" method="POST">
                <div class="modal-body">
                    
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="seo_url" class="form-label">SEO URL</label>
                            <input type="seo_url" class="form-control" id="seo_url" name="seo_url" required>
                        </div>

                        <div class="mb-3">
                            <label for="faculty" class="form-label">Faculty</label>
                            <select class="form-select" id="faculty" name="faculty" required>
                                <option value="">Select Faculty</option>
                                @foreach($facultys as $faculty)
                                    <option value="{{$faculty->facultyId}}">{{$faculty->facultyName}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="Undergraduate">Undergraduate</option>
                                <option value="Postgraduate">Postgraduate</option>

                            </select>
                        </div>

                        
                        <input type="text" class="form-control" id="corsesId" name="corsesId" hidden>
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
        // add student modal open
        document.getElementById('addCorese').onclick = function() {
            document.getElementById('corseModel').style.display = 'block';
        }

        // close modal
        document.getElementById('coseModel').onclick = function() {
            document.getElementById('corseModel').style.display = 'none';
            document.getElementById('name').value = '';
            document.getElementById('seo_url').value = '';
            document.getElementById('faculty').value = '';
            document.getElementById('category').value = '';
            document.getElementById('corsesId').value = '';
        }
    });



    function editTeacher(corse){
        document.getElementById('name').value = corse.name;
        document.getElementById('seo_url').value = corse.seo_url;
        document.getElementById('faculty').value = corse.facultyId;
        document.getElementById('category').value = corse.category;
        document.getElementById('corsesId').value = corse.id;
        document.getElementById('corseModel').style.display = 'block';
    }
</script>
