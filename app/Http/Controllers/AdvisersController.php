<?php

namespace App\Http\Controllers;

use App\Mail\requestAdvisers;
use App\Models\Advisers;
use App\Models\Comments;
use App\Models\Requests;
use App\Models\Requestsview;
use App\Models\Teams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdvisersController extends Controller
{
    public function panel(){
        return view('advisers.panel-adviser',['notifications' => Requestsview::where('fk_adviser','=',session()->get('LoggedUser')->id)->get()]);
    }

    public function completeRegister(Request $request){
        $this->isValid($request);
        $adviser = Advisers::where('id','=',session()->get('LoggedUser')->id)->first();
        if($adviser){
            $adviser->name = $request->name;
            $adviser->password = Hash::make($request->password);
            $adviser->status = 1;
            if($adviser->save()){
                session()->put('LoggedUser',$adviser);
                notify()->success(__('adviser-dashboard.NOTIFY-COMPLETE-REGISTER'),__('public.SUCCESS'));
                return redirect('/panel-asesores');
            }else{
                notify()->error(__('adviser-dashboard.NOTIFY-INCOMPLETE-REGISTER'),__('public.ERROR'));
                return redirect('/panel-asesores');
            }
        }else{
            notify()->error(__('adviser-dashboard.NOTIFY-INCOMPLETE-REGISTER'),__('public.ERROR'));
            return redirect('/panel-asesores');
        }
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80',
            'password' => 'required|min:8',
        ]);
    }
    private function commentIsValid(Request $request){
        $request->validate([
            'comment' => 'required',
        ]);
    }

    public function submitComment (Request $request){
        $this->commentIsValid($request);
        $comment = new Comments;
        $comment->fk_adviser = session()->get('LoggedUser')->id;
        $comment->fk_team = $request->TeamId;
        $comment->senddate = Carbon::now();
        if($comment->save()){
            notify()->success(__('adviser-dashboard.NOTIFY-COMMENT-COMPLETE'),__('public.SUCCESS'));
            return redirect()->route('adviser.teamView',['id' => $request->TeamId]);
        }
        notify()->error(__('adviser-dashboard.NOTIFY-COMMENT-INCOMPLETE'),__('public.ERROR'));
        return redirect()->route('adviser.teamView',['id' => $request->TeamId]);
    }

    public function submitVBO(Request $request){
        $team = Teams::find($request->TeamId);
        $team->vbo = 1;
        if($team->save()){
            notify()->success(__('adviser-dashboard.NOTIFY-VBO-COMPLETE'),__('public.SUCCESS'));
            return redirect()->route('adviser.teamView',['id' => $request->TeamId]);
        }
        notify()->error(__('adviser-dashboard.NOTIFY-VBO-INCOMPLETE'),__('public.ERROR'));
        return redirect()->route('adviser.teamView',['id' => $request->TeamId]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'emailadviser' => 'required|email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
        ]);
        $adviser = Advisers::where('email','=',$request->emailadviser)->first();
        if(!$adviser){
            $pass = Str::random(8);
            $adviser = new Advisers;
            $adviser->email = $request->emailadviser;
            $adviser->password = Hash::make($pass);
            $adviser->status = 0;
            $adviser->role = 1;
            if($adviser->save()){
                $this->sendRequestAdviser($request,$adviser,$pass);
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-ADVISER-SUCCESS'),__('public.SUCCESS'));      
                return redirect()->route('admins.advisers');
            }
        }else{
            $this->sendRequestAdviser($request,$adviser,null);
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-ADVISER-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.advisers');
        }  
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-ADVISER-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.advisers');    
    }

    private function sendRequestAdviser($request,$adviser,$pass){
        if($adviser){
            $requestAdviser = new Requests(); 
            $requestAdviser->requestdate = Carbon::now();
            $requestAdviser->fk_adviser = $adviser->id;
            $requestAdviser->fk_team = $request->idTeam;
            if($requestAdviser->save()){
                if($pass != null){
                    $data = [
                        'password' => $pass,
                        'admin' => session()->get('LoggedUser')->name,
                    ];
                    Mail::to($adviser->email)->send(new requestAdvisers($data)); 
                    return true;
                }else{
                    return true;
                }
            }
        }else{
            return false;
        }
    }

    public function show(Advisers $advisers)
    {
        //
    }

    public function edit(Advisers $advisers)
    {
        //
    }

    public function update(Request $request, Advisers $adviser)
    {
        $this->isValidforUpdate($request);
        $adviser->name = $request->name;
        $adviser->email = $request->emailadviser;
        if($adviser->save()){
            notify()->success(__('admin-dashboard.NOTIFY-UPDATE-ADVISER-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.advisers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-UPDATE-ADVISER-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.advisers');
    }

    public function destroy(Advisers $adviser)
    {
        $teams = DB::table('teams')->where('fk_adviser','=',$adviser->id)->get();
        $requests = DB::table('requests')->where('fk_adviser','=',$adviser->id)->get();
        $flag = true;
        if (count($requests) > 0) {    
            $deleted = DB::table('requests')->where('fk_adviser','=',$adviser->id)->delete();
            $flag = $deleted > 0? true : false;
        }
        if (count($teams) > 0) {
            foreach ($teams as $item) {
                $item->fk_adviser = null;
                $flag = $item->save()? true : false;
            }
        }
        if($flag){
            $adviser->delete();
            notify()->success(__('admin-dashboard.NOTIFY-UPDATE-ADVISER-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.advisers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-UPDATE-ADVISER-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.advisers');
    }

    private function isValidforUpdate(Request $request){
        $request->validate([
            'name' => 'required|max:80',
            'emailadviser' => 'required|email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
        ]);
    }
    
}
