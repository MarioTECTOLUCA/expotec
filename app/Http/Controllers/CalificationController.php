<?php

namespace App\Http\Controllers;

use App\Models\Califications;
use App\Models\Requestsview;
use App\Models\Teams;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificationController extends Controller
{
    public function show($id){
        if(session()->get('LoggedUser')->role == 2){
            return view('evaluators._evaluation-evaluators',[   'notifications' => Requestsview::where('fk_evaluator','=',session()->get('LoggedUser')->id)->get(),
                                                            'evaluation' => DB::select('SELECT evaluations_has_items.*, evaluations.fk_categorie, items.* FROM evaluations_has_items LEFT JOIN evaluations ON evaluations_has_items.fk_evaluations = evaluations.id LEFT JOIN items ON evaluations_has_items.fk_items = items.id WHERE evaluations.fk_categorie = '.session()->get('LoggedUser')->fk_categorie.';'),
                                                            'id' => $id]);
        }else{
            $categorie = Teams::find($id)->fk_categorie;
            return view('components.private.create-califications',[     'evaluation' => DB::select('SELECT evaluations_has_items.*, evaluations.fk_categorie, items.* FROM evaluations_has_items LEFT JOIN evaluations ON evaluations_has_items.fk_evaluations = evaluations.id LEFT JOIN items ON evaluations_has_items.fk_items = items.id WHERE evaluations.fk_categorie = '.$categorie.';'),
                                                                        'id' => $id]);
        }
        
    }

    public function store(Request $request){
        try {
            for ($i=0; $i < sizeof($request->id); $i++) { 
                $cal = new Califications();
                $cal->fk_eva_has_items = $request->id[$i];
                $cal->fk_team = $request->idTeam;
                $cal->fk_evaluator = session()->get('LoggedUser')->id;
                $cal->score = $request->score[$i];
                $cal->date = Carbon::now();
                $cal->save();
            }
            notify()->success(__('adviser-dashboard.NOTIFY-VBO-COMPLETE'),__('public.SUCCESS'));
            return redirect()->route('evaluator.panel');
        } catch (Exception $th) {
            notify()->error(__('adviser-dashboard.NOTIFY-VBO-INCOMPLETE'),__('public.ERROR'));
            return redirect()->route('evaluator.panel');
        }
        notify()->error(__('adviser-dashboard.NOTIFY-VBO-INCOMPLETE'),__('public.ERROR'));
        return redirect()->route('evaluator.panel');
    }

    public function view(Califications $id){
        if(session()->get('LoggedUser')->role == 2){
            return view('components.private._view-califications',[  'notifications' => Requestsview::where('fk_evaluator','=',session()->get('LoggedUser')->id)->get(),
                                                                    'evaluation' => DB::table("califications_view")->where('teamId','=',$id->id)->get()]);
        }else{
            return view('components.private._update-califications',[ 'evaluation' => DB::table("califications_view")->where('teamId','=',$id->id)->get()]);
        }
    }


    public function update(Request $request){
        try {
            for ($i=0; $i < sizeof($request->idCal); $i++) { 
                $cal = Califications::find($request->idCal[$i]);
                $cal->fk_eva_has_items = $request->id[$i];
                $cal->fk_team = $request->idTeam;
                $cal->fk_evaluator = session()->get('LoggedUser')->id;
                $cal->score = $request->score[$i];
                $cal->date = Carbon::now();
                $cal->save();
            }
            notify()->success(__('adviser-dashboard.NOTIFY-VBO-COMPLETE'),__('public.SUCCESS'));
            return back();
        } catch (Exception $th) {
            notify()->error(__('adviser-dashboard.NOTIFY-VBO-INCOMPLETE'),__('public.ERROR'));
            return back();
        }
        notify()->error(__('adviser-dashboard.NOTIFY-VBO-INCOMPLETE'),__('public.ERROR'));
        return back();
    }
}
