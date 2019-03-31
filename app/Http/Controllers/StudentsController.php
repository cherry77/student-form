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
       $student = new Student();
       if($request->isMethod('post')){
           //1.控制器验证-这种方法会给我们首次注册错误信息
           /*$this->validate($request,[
               'Student.name' => 'required|min:2|max:20',
               'Student.age' => 'required|integer',
               'Student.sex' => 'required|integer'
           ],[
               'required' => ':attribute为必填项',
               'min' => ':attribute长度不符合要求',
               'integer' => ':attribute必须为整数'
           ],[
               'Student.name' => '姓名',
               'Student.age' => '年龄',
               'Student.sex' => '性别'
           ]);*/
           //2.全局Validator类验证--需要withErrors注册错误信息
           $validator = \Validator::make($request->input(),[
               'Student.name' => 'required|min:2|max:20',
               'Student.age' => 'required|integer',
               'Student.sex' => 'required|integer'
           ],[
               'required' => ':attribute为必填项',
               'min' => ':attribute长度不符合要求',
               'integer' => ':attribute必须为整数'
           ],[
               'Student.name' => '姓名',
               'Student.age' => '年龄',
               'Student.sex' => '性别'
           ]);
           if($validator->fails()){
               //withInput--//3.数据保持
               return redirect()->back()->withErrors($validator)->withInput();
           }
           $data = $request->input('Student');
           //用create来新增
           if(Student::create($data)){
               return redirect('student/index')->with('success','添加成功');
           }else{
               return redirect()->back();
           }
       }
       return view('students.create',['student' => $student]);
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

    /**
     * 修改学生
     * @param Request $request
     * @param $sid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
   public function edit(Request $request,$sid){
       //路由里设置的{sid},在这里可以直接获取到
//       $student = new Student();
       //1.查找
       $student = Student::find($sid);
        //2.修改
       if($request->isMethod('post')){
           //验证
           $this->validate($request,[
               'Student.name' => 'required|min:2|max:20',
               'Student.age' => 'required|integer',
               'Student.sex' => 'required|integer'
           ],[
               'required' => ':attribute为必填项',
               'min' => ':attribute长度不符合要求',
               'integer' => ':attribute必须为整数'
           ],[
               'Student.name' => '姓名',
               'Student.age' => '年龄',
               'Student.sex' => '性别'
           ]);
           $data = $request->input('Student');
           $student->name = $data['name'];
           $student->age = $data['age'];
           $student->sex = $data['sex'];
           if($student->save()){
               return redirect('student/index')->with('success','修改成功-'.$student->sid);
           }
       }
       return view('students.edit',['student' => $student]);
   }

    /**
     * 查看详情
     * @param $sid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function detail($sid){
       $student = Student::find($sid);
       return view('students.detail',['student' => $student]);
   }

   public function delete($sid){
       //1.删除之前查找
       $student = Student::find($sid);
       if($student->delete()){
           return redirect('student/index')->with('success','删除成功-'.$sid);
       }else{
           return redirect('student/index')->with('success','删除失败-'.$sid);
       }
   }

}