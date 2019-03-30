<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{

    protected $table = "student";

    public $timestamps  = true;

    protected $fillable = ['name','age','sex'];

    protected function getDateFormat()
    {
        return time();
    }
    protected function asDateTime($value)
    {
        return $value;
    }
}