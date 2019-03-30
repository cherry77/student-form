<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
   public function index(){
       $students = Student::paginate(20);
       return view('students.index',[
           'students' => $students
       ]);
   }

    /**
     * 渲染新增页面，添加的逻辑也可以在渲染页面的方法里写
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function create(Request $request){
       if($request->isMethod('post')){
           $data = $request->input('Student');
           //用create来新增
           if(Student::create($data)){
               return redirect('student/index')->with('success','添加成功');
           }else{
               return redirect()->back();
           }
       }
       return view('students.create');
   }

    /**
     * 添加方法
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
   public function save(Request $request){
       $data = $request->input('Student');
       $student = new Student();
       $student->name = $data['name'];
       $student->age = $data['age'];
       $student->sex = $data['sex'];
       if($student->save()){
           return redirect('student/index')->with('success','添加成功');
       }else{
           return redirect()->back();
       }
   }
}