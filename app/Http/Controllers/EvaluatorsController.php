<?php

namespace App\Http\Controllers;

use App\Mail\newPasswordMailable;
use App\Mail\requestEvaluator;
use App\Models\califications_view;
use App\Models\Evaluators;
use App\Models\Requestsview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EvaluatorsController extends Controller
{

    public function index()
    {
        return view('evaluators.panel-evaluators',[ 'notifications' => Requestsview::where('fk_evaluator','=',session()->get('LoggedUser')->id)->get(),
                                                    'teams' => DB::select("SELECT id,teamId,teamName, SUM(score) AS 'score', categorieName FROM califications_view WHERE categorieId = ".session()->get('LoggedUser')->fk_categorie." AND vbo = 1 GROUP BY teamId,teamName,categorieName")]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->isValid($request);
        $evaluator = Evaluators::where('email','=',$request->email)->first();
        if (!$evaluator) {
            $pass = Str::random(8);
            $evaluator = new Evaluators;
            $evaluator->name = $request->name;
            $evaluator->email = $request->email;
            $evaluator->password = Hash::make($pass);
            $evaluator->role = 2;
            $evaluator->status = 1;
            $evaluator->fk_categorie = $request->categorie;
            $evaluator->fk_event = $request->event;
            if($evaluator->save()){
                $this->sendRequestEvaluator($evaluator,$pass);
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-EVALUATOR-SUCCESS'),__('public.SUCCESS'));      
                return redirect()->route('admins.evaluators');
            }
        }
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-EVALUATOR-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.evaluators');    
    }

    private function sendRequestEvaluator($evaluator,$pass){
        if($evaluator){
            if($pass != null){
                $data = [
                    'password' => $pass,
                    'admin' => $evaluator->name,
                ];
                Mail::to($evaluator->email)->send(new requestEvaluator($data)); 
                return true;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    public function editPassword(Evaluators $evaluator){
        $pass = Str::random(8);
        $evaluator->password = Hash::make($pass);
        if($evaluator->save()){
            $data = [
                'name' => $evaluator->name,
                'password' => $pass,
            ];
            Mail::to($evaluator->email)->send(new newPasswordMailable($data));
            notify()->success(__('admin-dashboard.NOTIFY-UPDATEPASS-STUDENT-SUCCESS'),__('public.SUCCESS'));
            return redirect()->route('admins.evaluators');    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluators  $evaluators
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluators $evaluators)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluators  $evaluators
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluators $evaluators)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluators  $evaluators
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluators $evaluator)
    {
        $this->isValid($request);
        $evaluator->name = $request->name;
        $evaluator->email = $request->email;
        $evaluator->fk_categorie = $request->categorie;
        $evaluator->fk_event = $request->event;
        if ($evaluator->save()) {
            notify()->success(__('admin-dashboard.NOTIFY-UPDATE-EVALUATOR-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.evaluators');
        }
        notify()->error(__('admin-dashboard.NOTIFY-UPDATE-EVALUATOR-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.evaluators'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluators  $evaluators
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluators $evaluators)
    {
        //create function validateif calificactions exists
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80|regex:/^[A-Za-z0-9\s]+$/i',
            'email' => 'required|email|unique:students,email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
            'event'=>'required',
            'categorie'=>'required',
        ]);
    }
}
