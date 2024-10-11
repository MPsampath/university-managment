<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public static function home(Request $request)
    {
        $teachers = User::getUser('TEACHER');
        return view('pages.teacher.teacher_home')->with(['teachers'=>$teachers,'message'=>'','type'=>'']);
     
    }

    public static function store(Request $request)
    {
        try {
            
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        
        User::addOrUpdate($request->teacherId,$request->name,$request->email,'TEACHER');
        $teachers = User::getUser('TEACHER');
        return redirect()->route('teacher_home')->with(['teachers'=>$teachers,'message'=>'Teacher Added Successfully','type'=>'success']);

        } catch (\Throwable $th) {
            return redirect()->route('teacher_home')->with(['message'=>'Teacher Not Added','type'=>'danger']);
        }
    }

    public static function delete(Request $request){
        try {
            User::deleteUser($request->id);
            $teachers = User::getUser('TEACHER');
            return redirect()->route('teacher_home')->with(['teachers'=>$teachers,'message'=>'Teacher Deleted Successfully','type'=>'success']);
        } catch (\Throwable $th) {
            return redirect()->route('teacher_home')->with(['message'=>'Teacher Not Deleted','type'=>'danger']);
        }
    }
}
