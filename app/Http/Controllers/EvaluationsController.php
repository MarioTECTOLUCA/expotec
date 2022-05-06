<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Evaluations;
use App\Models\Evaluations_has_items;
use App\Models\EvaluationView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evaluation = new Evaluations();
        $evaluation->name = $request->name;
        $evaluation->score = $request->score;
        $evaluation->fk_categorie = $request->categoria;

        if($evaluation->save()){
            foreach ($request->array as $item) {
                $e_has_i = new Evaluations_has_items();
                $e_has_i->fk_evaluations = $evaluation->id;
                $e_has_i->fk_items = $item; 
                if(!$e_has_i->save()){
                    notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
                    return redirect('/panel-a-evaluations');
                }
            }
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-EVELUATION-SUCCESS'),__('public.SUCCESS'));
            return redirect('/panel-a-evaluations');
        }else{
            notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
            return redirect('/panel-a-evaluations');
        }
    }

    public function show($id)
    {   
        $result = DB::table('evaluation_view')->select('evaluation_view.fk_items')->where('fk_evaluations','=',$id)->get();
        $array = [];
        foreach ($result as $item) {
            array_push($array, $item->fk_items);
        }
        return view('components.private._update-evaluation',[   'items' => DB::table('items')->whereNotIn('id',$array)->get(),
                                                                'evaluationView' => EvaluationView::where('fk_evaluations','=',$id)->get(),
                                                                'categories' => Categories::all()]);
    }

    public function edit(Evaluations $evaluations)
    {
        
    }

    public function update(Request $request, Evaluations $evaluation)
    {          
        $evaluation->name = $request->name;
        $evaluation->score = $request->score;
        $evaluation->fk_categorie = $request->categoria;
        if ($evaluation->save()) {
            $eva_has_item = Evaluations_has_items::where('fk_evaluations','=',$evaluation->id)->get();
            $aux = [];
            
            foreach ($eva_has_item as $key) {
                array_push($aux, $key->fk_items); 
            }    
            $forinsert = array_diff($request->array,$aux);
            $fordelete = array_diff($aux,$request->array);
            foreach ($forinsert as $item) {
                $e_has_i = new Evaluations_has_items();
                $e_has_i->fk_evaluations = $evaluation->id;
                $e_has_i->fk_items = $item;
                if($e_has_i->save()){
                    foreach ($fordelete as $key) {
                        $deleted = DB::table('evaluations_has_items')
                            ->where('fk_evaluations','=',$evaluation->id)
                            ->where('fk_items','=',$key)->delete();  
                    }
                    if ($deleted > 0) {
                        notify()->success(__('admin-dashboard.items-success-update'),__('public.SUCCESS'));
                        return redirect()->route('admin.evaluations-show',$evaluation->id);
                    }
                }
            }
            notify()->success(__('admin-dashboard.items-success-update'),__('public.SUCCESS'));
            return redirect()->route('admin.evaluations-show',$evaluation->id);
        }
        notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
        return redirect()->route('admin.evaluations-show',$evaluation->id);
    }

    public function destroy(Evaluations $evaluation)
    {   
        $deleted = DB::table('evaluations_has_items')
                            ->where('fk_evaluations','=',$evaluation->id)->delete();                 
        if($deleted != 0){
            if ($evaluation->delete()) {
                notify()->success(__('admin-dashboard.items-success-update'),__('public.SUCCESS'));
                return redirect('/panel-a-evaluations');
            }
        }
        notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
        return redirect('/panel-a-evaluations');
    }
}
