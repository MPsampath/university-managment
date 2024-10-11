@extends('layouts.common_component')

@section('content')
    <div class="container">

    @if (Auth::user()->role == 'ADMIN')

        <div class="row">
            <div class="card">
            <a href="{{route('teacher_home')}}"><div class="card-body">Teacher / Tutor</div></a>
            </div>
        </div>

        <div class="row">
            <div class="card">
            <a href="{{route('student_home')}}"><div class="card-body">Students</div></a>
            </div>
        </div>
        
    @endif

        <div class="row">
                <div class="card">
                <a href="{{route('course_home')}}"><div class="card-body">Corses</div></a>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="card">
                <a href="{{route('course_home')}}"><div class="card-body">Corses</div></a>
                </div>
            </div>
        </div>
@endsection