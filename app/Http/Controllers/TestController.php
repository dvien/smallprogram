<?php
/**
 * Created by PhpStorm.
 * User: richer
 * Date: 2017/7/29
 * Time: 上午8:43
 */

namespace App\Http\Controllers;


use App\Student;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test(){
        echo 5534493457;
    }

    public function test2(){
//        $res = DB::insert('insert into student (name,age,addtime) values (?,?,?) ',['里斯',58,time()]);
//        var_dump($res);
//
//        $find = DB::select('select * from student');
//        dd($find);

        $student = Student::all();
        var_dump($student);

        $res = Student::firstOrCreate(['name'=>'张亮','age' => 123,'addtime' => 1234]);
        dump($res);


    }
}