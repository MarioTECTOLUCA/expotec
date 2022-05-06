<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Adviser;
use App\Models\Admins;
use App\Models\Advisers;
use App\Models\Evaluators;

class AuthController extends Controller
{
    function check(Request $request){
        $request->validate([
            'user'=>'required',
            'password' => 'required|min:8',]);
       
        if($student = Students::where('noctrl','=',$request->user)->first()){
            return $this->loginStudents($student,$request);
        }else if($student = Students::where('email','=',$request->user)->first()){
            return $this->loginStudents($student,$request);
        }else if($adviser = Advisers::where('email','=',$request->user)->first()){
            return $this->loginAdvisers($adviser,$request);
        }else if($admin = Admins::where('email','=',$request->user)->first()){
            return $this->loginAdmins($admin,$request);
        }else if($evaluator = Evaluators::where('email','=',$request->user)->first()){
            return $this->loginEvaluators($evaluator,$request);
        }
        return redirect('/');
    }

    function loginStudents($student,$request){
        if($student){
            if(Hash::check($request->password, $student->password)){
                $request->session()->put('LoggedUser',$student);
                notify()->success(__('auth.AUTHSUCCESS'),__('public.SUCCESS'));
                return redirect()->route('students.panel');
            }else{
                notify()->error(__('auth.AUTHBADPASSWORD'),__('public.ERROR'));
                return redirect('/');
            }
        }else{
            notify()->error(__('auth.AUTHBADCREDENTIALS'),__('public.ERROR'));
            return redirect('/');
        }
    }

    function loginAdvisers($adviser,$request){
        if($adviser){
            if(Hash::check($request->password, $adviser->password)){
                $request->session()->put('LoggedUser',$adviser);
                notify()->success(__('auth.AUTHSUCCESS'),__('public.SUCCESS'));
                return redirect('/panel-asesores');
            }else{
                notify()->error(__('auth.AUTHBADPASSWORD'),__('public.ERROR'));
                return redirect('/');
            }
        }else{
            notify()->error(__('auth.AUTHBADCREDENTIALS'),__('public.ERROR'));
            return redirect('/');
        }
    }

    function loginEvaluators($evaluator,$request){
        if($evaluator){
            if(Hash::check($request->password, $evaluator->password)){
                $request->session()->put('LoggedUser',$evaluator);
                notify()->success(__('auth.AUTHSUCCESS'),__('public.SUCCESS'));
                return redirect()->route('evaluator.panel');
            }else{
                notify()->error(__('auth.AUTHBADPASSWORD'),__('public.ERROR'));
                return redirect('/');
            }
        }else{
            notify()->error(__('auth.AUTHBADCREDENTIALS'),__('public.ERROR'));
            return redirect('/');
        }
    }

    function loginAdmins($admin,$request){
        if($admin){
            if(Hash::check($request->password, $admin->password)){
                $request->session()->put('LoggedUser',$admin);
                notify()->success(__('auth.AUTHSUCCESS'),__('public.SUCCESS'));
                return redirect()->route('admins.panel');
            }else{
                notify()->error(__('auth.AUTHBADPASSWORD'),__('public.ERROR'));
                return redirect('/');
            }
        }else{
            notify()->error(__('auth.AUTHBADCREDENTIALS'),__('public.ERROR'));
            return redirect('/');
        }
    }

    function logout(){
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            notify()->success(__('auth.AUTHSUCCESS-LOGOUT'),__('public.SUCCESS'));
            return redirect('/');
        }else{
            notify()->error(__('auth.AUTHERROR-LOGOUT'),__('public.ERROR'));
            return redirect('/');
        }
    }
}
