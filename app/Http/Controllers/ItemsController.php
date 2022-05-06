<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Exception;
use Illuminate\Http\Request;

class ItemsController extends Controller
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
        $this->isValid($request);
        $items = new Items;
        $items->name = $request->name;
        $items->score = $request->score;
        if($items->save()){
            notify()->success(__('admin-dashboard.items-success-store'),__('public.SUCCESS'));
            return redirect('/panel-a-evaluations');
        }
        notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
        return redirect('/panel-a-evaluations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->isValid($request);
        $item = Items::find($request->id);
        $item->name = $request->name;
        $item->score = $request->score;
        if ($item->save()) {
            notify()->success(__('admin-dashboard.items-success-update'),__('public.SUCCESS'));
            return redirect('/panel-a-evaluations');
        }
        notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
        return redirect('/panel-a-evaluations');
    }

    public function destroy(Items $id)
    {
        try{
            $id->delete();
            notify()->success(__('admin-dashboard.items-success-update'),__('public.SUCCESS'));
            return redirect('/panel-a-evaluations');
        }catch(Exception $e){     
            notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
            return redirect('/panel-a-evaluations');       
        }
        notify()->error(__('admin-dashboard.items-error-store'),__('public.ERROR'));
        return redirect('/panel-a-evaluations');
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80|regex:/^[A-Za-z0-9\s]+$/i',
            'score'=>'required|numeric|min:1|max:100'
        ]);
    }
}
