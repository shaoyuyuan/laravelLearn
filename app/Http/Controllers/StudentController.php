<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use App\Student;
//上传文件
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Mail;
/**
 * 
 */
class StudentController extends Controller
{
	//列表
	public function index()
	{
		$students = Student::paginate(10);
		// dd($students);
		return view('student.index', [
			'students' => $students
		]);
	}
	//添加页面
	public function create(Request $request)
	{
		$student = new Student();

		if ($request->isMethod('POST')) {

			//1、控制器验证
			/*$this->validate($request, [
				'Student.name' => 'required|min:2|max:20',
				'Student.age'  => 'required|integer',
				'Student.sex'  => 'required'
			], [
				'required' => ':attribute 为必填项',
				'min' => ':attribute 长度不符合',
				'integer' => ':attribute 必须为整数',
			], [
				'Student.name' => '姓名',
				'Student.age' => '年龄',
				'Student.sex' => '性别',
			]);*/
			//2.Validator类验证
			$validator = \Validator::make($request->input(),[
					'Student.name' => 'required|min:2|max:20',
					'Student.age'  => 'required|integer',
					'Student.sex'  => 'required'
				], [
					'required' => ':attribute 为必填项',
					'min' => ':attribute 长度不符合',
					'integer' => ':attribute 必须为整数',
				], [
					'Student.name' => '姓名',
					'Student.age' => '年龄',
					'Student.sex' => '性别',
				]);
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}

			$data = $request->input('Student');
			//create 需要定义model 中fillable
			if (Student::create($data)) {
				return redirect('student/index')->with('success', '添加成功');
			} else {
				return redirect('back');
			}
		}
		return view('student.create', [
			'student' => $student
		]);
	}
	//保存
	public function save(Request $request)
	{
		$data = $request->input('Student');
		$student = new Student();
		$student->name = $data['name'];
		$student->age = $data['age'];
		$student->sex = $data['sex'];

		if ($student->save()) {
			return redirect('student/index');
		} else {
			return redirect('back');
		}
	}

	public function update(Request $request, $id)
	{
		$student = Student::find($id);
		if ($request->isMethod("POST")) {
			$data = $request->input('Student');
			$student->name = $data['name'];
			$student->age = $data['age'];
			$student->sex = $data['sex'];
			if ($student->save()) {
				return redirect('student/index')->with('success', '修改成功' . $id);
			}
		}
		return view('student.update', [
			'student' => $student
		]);
	}

	public function detail($id)
	{
		$student = Student::find($id);
		return view('student.detail', [
			'student' => $student
		]);
	}

	public function delete($id)
	{
		$student = Student::find($id);
		if ($student->delete()) {
			return redirect('student/index')->with('success', '删除成功' . $id);
		} else {
			return redirect('student/index')->with('error', '删除失败' . $id);
		}
	}

	public function upload(Request $request)
	{
		if ($request->isMethod('POST')) {
			// var_dump($_FILES);
			$file = $request->file('source');
			//文件是否上传成功
			if ($file->isValid()) {
				//原文件名
				$originalName = $file->getClientOriginalName();
				//扩展名
				$ext = $file->getClientOriginalExtension();
				//MimeType
				$type = $file->getClientMimeType();
				//临时绝对路径
				$realpath = $file->getRealPath();

				$filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
				$bool = Storage::disk('uploads')->put($filename, file_get_contents($realpath));
				var_dump($bool);
				exit;
			}
			// dd($file);
		}
		return view('student/upload');
	}

	public function cache1()
	{
		//put()保存对象到缓存中
		//Cache::put('key1', 'value1', 10);
		
		//add()添加缓存(存在key返回false，不存在true)
		// $bool = Cache::add('key2', 'value2', 10);
		 
		//forever永久保存缓存
		Cache::forever('key3', 'value3');
		
		//has() 判断可以是否存在
		// if (Cache::has('key1')) {
		// 	$val = Cache::get('key1');
		// 	echo $val;
		// } else {
		// 	echo "NO";
		// }
		
		// var_dump($bool);
	}
	public function cache2()
	{
		//get获取缓存中对象
		// $val = Cache::get('key3');
		// dd($val);
		 
		// pull()获取缓存并删除
		// $val = Cache::pull('key3');
		// var_dump($val);
		 
		// forget()删除缓存对象，成功返回true否则false
		$bool = Cache::forget('key1');
		var_dump($bool);

	}

	public function mail()
	{
		Mail::raw('邮件内容', function($message){
			$message->from('json_vip@163.com', 'syy');
			$message->subject('邮件主题 测试');
			$message->to('305400706@qq.com');
		});
	}

	public function error()
	{
		// $student = null;
		// if ($student == null) {
		// 	abort('503');
		// }
		
		// Log::info('这是一个info级别日志');
		// Log::warning('这是一个warning级别日志');
		Log::error('这是一个error级别日志', ['name'=>'sean', 'age'=>18]);
	}

	public function queue()
	{
		dispatch(new \App\Jobs\SendEmail('123456@qq.com'));
	}
}