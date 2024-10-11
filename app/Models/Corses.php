<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corses extends Model
{
    use HasFactory;
    protected $table = 'corses';
    protected $primaryKey = 'id';

    public static function getCorses()
    {
        return Corses::selectRaw('TIMESTAMPDIFF(HOUR, corses.created_at, NOW()) AS hours_diff,faculties.*,corses.*')->leftjoin('faculties','faculties.facultyId','corses.facultyId')->get();
    }

    public static function addOrUpdate($corsesId,$name,$seoUrl,$faculty_id,$category,$status)
    {
        $corses = $corsesId ? Corses::find($corsesId) : new Corses();
        $corses->name = $name;
        $corses->seo_url = $seoUrl;
        $corses->facultyId = $faculty_id;
        $corses->category = $category;
        $corses->status = $status;
        $corses->save();
    }

    public static function getCorse($corseId)
    {
        return Corses::selectRaw('TIMESTAMPDIFF(HOUR, corses.created_at, NOW()) AS hours_diff,faculties.*,corses.*')->leftjoin('faculties','faculties.facultyId','corses.facultyId')->where('corses.id',$corseId)->first();
    }
}
