<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    //
    public function index(){
        $res = DB::table('school') -> paginate(15);
        //dd($res);
        return view('admin/school/index') -> with([
            'res' => $res
        ]);
    }

    public function addSchool(){
        return view('admin/school/addSchool');
    }

    public function addSchoolRes(Request $request){
        /*
        $isset = DB::table('school') -> where([
            'name' => $request -> input('schoolname')
        ]) -> first();
        if($isset){
            return redirect('admin/school') -> with([
                'isset' => 'yes'
            ]);
        }
        */

        $file = $request -> file('logo');
        $filename = '';
        if($file -> isValid()){
            //如果上传成功
            $ext = $file -> getClientOriginalExtension();
            $realpath = $file  -> getRealPath();
            $filename = date('Y-m-d-H:i:s').'-'.uniqid().'.'.$ext;
            $bool = Storage::disk('uploads')->put($filename,file_get_contents($realpath));
        }


        $res = DB::table('school') -> insert([
            'schoolname' => $request -> input('schoolname'),
            'name' => $request -> input('name'),
            'tel' => $request -> input('tel'),
            'guanwang' => $request -> input('guanwang'),
            'year' => $request -> input('year'),
            'content' => $request -> input('content'),
            'logo' => $filename,
            'created_at' => time(),
        ]);
        if($res){
            return redirect('admin/school') -> with([
                'addres' => 'yes'
            ]);
        }
    }

    public function editSchool($id){
        $res = DB::table('school') -> where([
            'id' => $id
        ]) -> first();
        return view('admin/school/addSchool') -> with([
            'res' => $res
         ]);
    }

    public function editSchoolRes(Request $request){


        $file = $request -> file('logo');
        //$filename = '';
        if($file && $file -> isValid()){
            dump($file);
            //如果上传成功
            $ext = $file -> getClientOriginalExtension();
            $realpath = $file  -> getRealPath();
            $filename = date('Y-m-d-H:i:s').'-'.uniqid().'.'.$ext;
            $bool = Storage::disk('uploads')->put($filename,file_get_contents($realpath));
            $savedata['logo'] = $filename;
            dump($savedata);
        }

        $savedata['schoolname'] = $request -> input('schoolname');
        $savedata['name'] = $request -> input('name');
        $savedata['tel'] = $request -> input('tel');
        $savedata['guanwang'] = $request -> input('guanwang');
        $savedata['year'] = $request -> input('year');
        $savedata['content'] = $request -> input('content');
        $savedata['created_at'] = time();
        

        $res = DB::table('school') -> where([
            'id' => $request -> input('id')
        ]) -> update($savedata);

        if($res){
            return redirect('admin/school') -> with([
                'editres' => 'yes'
            ]);
        }
    }

    //删除
    public function deleteSchool($id){
        $res = DB::table('school') -> where([
            'id' => $id
        ]) -> delete();
        if($res){
            return redirect('admin/school') -> with([
                'deleteres' => 'yes'
            ]);
        }
    }

    public function apiSchool(){
        $res = DB::table('school') -> where([
            'status' => 0
        ]) -> get();
        return response() -> json($res);
    }




}
