<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;
    protected $table = 'modules';
    protected $primaryKey = 'id';

    public static function getModules($coreId)
    {
        return Modules::where('course_id',$coreId)->get();
    }

    public static function codeGenerator()
    {
        $quary = Modules::select('code')->orderBy('code', 'DESC');
        $code = $quary->exists() ? $quary->first()->code : 'MDL000';

        do {
            $code++;
            $exists = Modules::where('code', $code)->exists();
        } while ($exists);
        return $code;
    }

    public static function addOrUpdate($moduleId,$code,$name,$semester,$status,$type,$credit,$description,$corseId)
    {
        $module = $moduleId ? Modules::find($moduleId) : new Modules();
       
        $module->code = $code;
        $module->name = $name;
        $module->semester = $semester;
        $module->type = $type;
        $module->credit = $credit;
        $module->description = $description;
        $module->status = $status;
        $module->course_id = $corseId;
        $module->save();
    }
}
