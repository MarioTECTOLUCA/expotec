<?php

namespace App\Http\Controllers;

use App\Mail\ContactMailable;
use App\Mail\newPasswordMailable;
use App\Models\Careers;
use App\Models\Gender;
use App\Models\Requestsview;
use App\Models\Students;
use App\Models\Teams;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StudentsController extends Controller
{
    public function read(){
        return view('',['students' => Students::all()]);
    }

    public function panel(){
        return view('students.panel-estudiantes',['notifications' => Requestsview::where('fk_student','=',session()->get('LoggedUser')->id)->get()]);
    }

    public function create(Request $request){
        $this-> isValid($request); 

        $student = new students;
        
        $student->name = $request->name;
        $student->noctrl = $request->noctrl;
        $student->fk_gender = $request->genero;
        $student->semester = $request->semestre;
        $student->birthday = $request->nac;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->status = 0;
        $student->role = 0;
        $student->fk_career = $request->career;
        if($student->save()){
            $data = [
                'name' => $student->name,
            ];
            Mail::to($student->email)->send(new ContactMailable($data));
            if(Session::has('LoggedUser') && session()->get('LoggedUser')->role == 3){
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-STUDENT-SUCCESS'),__('public.SUCCESS'));
                return redirect()->route('admins.students');
            }else{
                $request->session()->put('LoggedUser',$student);
                notify()->success(__('students-dashboard.NOTIFY-COMPLETE-REGISTER'),__('public.SUCCESS'));
                return redirect()->route('admins.students');
            }
        }else{
            if(Session::has('LoggedUser') && session()->get('LoggedUser')->role == 3){
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-STUDENT-FAILED'),__('public.ERROR'));
                return redirect()->route('admins.students');
            }else{
                notify()->error(__('students-dashboard.NOTIFY-INCOMPLETE-REGISTER'),__('public.ERROR'));
                return redirect()->route('admins.students');
            }
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function show(Students $student)
    {
        return view('components.private._update-student',[  'student' => $student,
                                                            'gender' => Gender::all(),
                                                            'careers' => Careers::all()]);
    }

  
    public function editPassword(Students $student)
    {
        $pass = Str::random(8);
        $student->password = Hash::make($pass);
        if($student->save()){
            $data = [
                'name' => $student->name,
                'password' => $pass,
            ];
            Mail::to($student->email)->send(new newPasswordMailable($data));
            notify()->success(__('admin-dashboard.NOTIFY-UPDATEPASS-STUDENT-SUCCESS'),__('public.SUCCESS'));
            return redirect()->route('admin.students-show',$student->id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Students $student){
        $this-> isValidfoUpdate($request);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->noctrl = $request->noctrl;
        $student->semester = $request->semestre;
        $student->fk_gender = $request->gender;
        $student->fk_career = $request->career;
        $student->birthday = $request->nac;
        if ($student->save()) {
            if(Session::has('LoggedUser') && session()->get('LoggedUser')->role == 3){
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-STUDENT-SUCCESS'),__('public.SUCCESS'));
                return redirect()->route('admins.students');
            }else{
                $request->session()->put('LoggedUser',$student);
                notify()->success(__('students-dashboard.NOTIFY-COMPLETE-REGISTER'),__('public.SUCCESS'));
                return redirect('/panel-estudiantes');
            }
        }
        if(Session::has('LoggedUser') && session()->get('LoggedUser')->role == 3){
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-STUDENT-FAILED'),__('public.ERROR'));
            return redirect()->route('admins.students');
        }else{
            notify()->error(__('students-dashboard.NOTIFY-INCOMPLETE-REGISTER'),__('public.ERROR'));
            return redirect('/panel-estudiantes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Students  $students
     * @return \Illuminate\Http\Response
     */
    public function destroy(Students $student)
    {
        $count = count($teams = DB::table('students_has_teams')
        ->where('fk_student','=',$student->id)->get());
        $hasrequests = count(DB::table('requests')
            ->where('fk_student','=',$student->id)->get());
        $flag = false;
        if ($count > 0) {
            foreach ($teams as $item) {
                if (count(DB::table('students_has_teams')->where('fk_student','!=',$student->id)->where('fk_teams','=',$item->fk_teams)->get()) > 0) {
                    $deleted  = DB::table('students_has_teams')->where('fk_student','=',$student->id)->where('fk_teams','=',$item->fk_teams)->delete();
                    if($deleted > 0){
                        $deleted = DB::table('students')->where('id','=',$student->id)->delete();
                        if($deleted > 0){
                            $team = Teams::find($item->fk_teams);
                            $team->active_invitations = $team->active_invitations - 1 ;
                            $team->status = $team->status - 1;
                            if($team->save() == true){
                                $flag = true;
                            }
                        }
                    }
                }else{
                    $deleted  = DB::table('students_has_teams')->where('fk_student','=',$student->id)->where('fk_teams','=',$item->fk_teams)->delete();
                    if($deleted > 0){
                        if(count(DB::table('requests')->where('fk_team','=',$item->fk_teams)->get()) > 0){
                            $deleted  = DB::table('requests')->where('fk_team','=',$item->fk_teams)->delete();
                            if($deleted > 0){
                                $deleted  = DB::table('teams')->where('id','=',$item->fk_teams)->delete();
                                if($deleted > 0){
                                    $deleted = DB::table('students')->where('id','=',$student->id)->delete();
                                    $flag = $deleted > 0 ? true:false;
                                }
                            }
                        }else{
                            $deleted  = DB::table('teams')->where('id','=',$item->fk_teams)->delete();
                            if($deleted > 0){
                                $deleted = DB::table('students')->where('id','=',$student->id)->delete();
                                $flag = $deleted > 0 ? true:false;
                            }
                        }
                    }
                }
            }
        }else{
            if($hasrequests > 0){
                $deleted  = DB::table('requests')->where('fk_student','=',$student->id)->delete();
                if($deleted > 0){
                    $deleted = DB::table('students')->where('id','=',$student->id)->delete();
                    $flag = $deleted > 0 ? true:false;
                }
            }else{
                $deleted = DB::table('students')->where('id','=',$student->id)->delete();
                $flag = $deleted > 0 ? true:false;
            }
            
        }
        if ($flag) {
            notify()->success(__('admin-dashboard.NOTIFY-DELETE-STUDENT-SUCCESS'),__('public.SUCCESS'));
            return redirect()->route('admins.students');
        }
        notify()->success(__('admin-dashboard.NOTIFY-DELETE-STUDENT-FAILED'),__('public.ERROR'));
            return redirect()->route('admins.students');
        
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80|regex:/^[A-Za-z0-9\s]+$/i',
            'noctrl' => 'required|unique:students,noctrl',
            'genero' => 'required',
            'semestre' => 'required',
            'nac' => 'required|date|before:now',
            'email' => 'required|email|unique:students,email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
            'password' => 'required|min:8',
            'career'=>'required|numeric|min:1|max:13'
        ]);
    }
    private function isValidfoUpdate(Request $request){
        $request->validate([
            'name' => 'required|max:80|regex:/^[A-Za-z0-9\s]+$/i',
            'noctrl' => 'required|unique:students,noctrl',
            'gender' => 'required',
            'semestre' => 'required',
            'nac' => 'required|date|before:now',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
            'career'=>'required|numeric|min:1|max:13'
        ]);
    }
}
