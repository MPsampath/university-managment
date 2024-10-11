<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
   public static function facultyHome(Request $request)
   {
       return view('pages.faculty_home');
    
   }

   public static function departmentHome(Request $request)
   {
       return view('pages.departments_home');
    
   }
}
