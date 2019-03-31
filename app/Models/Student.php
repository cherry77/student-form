<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model{
    const SEX_UN = 0;//未知
    const SEX_BOY = 1;//男
    const SEX_GIRL = 2;//女

    protected $table = "student";
    protected $primaryKey = 'sid';

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
    public function fromDateTime($value)
    {
        return empty($value) ? $value : $this->getDateFormat();
    }
    public function getSex($type = null){
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GIRL => '女'
        ];
        if($type !== null){
            return isset($arr[$type])?$arr[$type]:$arr[self::SEX_UN];
        }
        return $arr;
    }
}