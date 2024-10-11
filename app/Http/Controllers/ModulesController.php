<?php

namespace App\Http\Controllers;

use App\Models\Corses;
use App\Models\Modules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ModulesController extends Controller
{
    public static function home(Request $request)
    {
        $modules = Modules::getModules($request->corseId);
        $corename = Corses::getCorse($request->corseId)->name;
        $code = Modules::codeGenerator();
        return view('pages.modules.moduls_home')->with(['modules'=>$modules,'message'=>'','type'=>'','code'=>$code,'corseId'=>$request->corseId,'corename'=>$corename]);
    }

    public static function store(Request $request){
        try {
            Modules::addOrUpdate($request->modulesId,$request->code,$request->name,$request->semester,'draft',$request->mtype,$request->credit,$request->descr,$request->corseId);
            $code = Modules::codeGenerator();
            $modules = Modules::getModules($request->corseId);
            return redirect()->route('module_home',['corseId' => $request->corseId])->with(['modules'=>$modules,'message'=>'Module Added Successfully','type'=>'success','code'=>$code]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public static function deleteModule(Request $request){
        try {
            Modules::destroy($request->id);
            $modules = Modules::getModules($request->corseId);
            $code = Modules::codeGenerator();
            return redirect()->route('module_home',['corseId' => $request->corseId])->with(['modules'=>$modules,'message'=>'Module Deleted Successfully','type'=>'success','code'=>$code]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
