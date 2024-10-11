<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public static function home(Request $request)
    {
        $students = User::getUser('STUDENT');
        return view('pages.student.student_home')->with(['students'=>$students,'message'=>'','type'=>'']);
     
    }

    public static function store(Request $request)
    {
        try {
            
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        
        User::addOrUpdate($request->studentId,$request->name,$request->email,'STUDENT');
        $students = User::getUser('STUDENT');
        return redirect()->route('student_home')->with(['students'=>$students,'message'=>'Student Added Successfully','type'=>'success']);

        } catch (\Throwable $th) {
            return redirect()->route('student_home')->with(['message'=>'Student Not Added','type'=>'danger']);
        }
    }

    public static function delete(Request $request){
        try {
            User::deleteUser($request->id);
            $students = User::getUser('STUDENT');
            return redirect()->route('student_home')->with(['students'=>$students,'message'=>'Student Deleted Successfully','type'=>'success']);
        } catch (\Throwable $th) {
            return redirect()->route('student_home')->with(['message'=>'Student Not Deleted','type'=>'danger']);
        }
    }
}
