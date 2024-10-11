<?php

namespace App\Http\Controllers;

use App\Models\Corses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CorsesController extends Controller
{
    public static function home()
    {
        $corses = Corses::getCorses();
        $faculty = DB::table('faculties')->get();
        return view('pages.corses.corses_home')->with(['corses'=>$corses,'facultys'=>$faculty,'message'=>'','type'=>'']);
    }

    public static function store(Request $request){
        try {
                
            Corses::addOrUpdate($request->corsesId,$request->name,$request->seo_url,$request->faculty,$request->category,'draft');
            $corses = Corses::getCorses();
            $faculty = DB::table('faculties')->get();
            return redirect()->route('course_home')->with(['corses'=>$corses,'facultys'=>$faculty,'message'=>'Course Added Successfully','type'=>'success']);
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public static function delete(Request $request){
        try {
            Corses::destroy($request->id);
            $corses = Corses::getCorses();
            $faculty = DB::table('faculties')->get();
            return redirect()->route('course_home')->with(['corses'=>$corses,'facultys'=>$faculty,'message'=>'Course Deleted Successfully','type'=>'success']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
