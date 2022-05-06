<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use Exception;
use Illuminate\Http\Request;

class CareersController extends Controller
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
        $career = new Careers;
        $career->name = $request->name;
        if($career->save()){
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-CAREERS-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-CAREERS-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Careers  $careers
     * @return \Illuminate\Http\Response
     */
    public function show(Careers $careers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Careers  $careers
     * @return \Illuminate\Http\Response
     */
    public function edit(Careers $careers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Careers  $careers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->isValid($request);
        $career = Careers::find($request->id);
        $career->name = $request->name;
        if ($career->save()) {
            notify()->success(__('admin-dashboard.NOTIFY-UPDATE-CAREERS-SUCCESS'),__('public.SUCCESS'));
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-UPDATE-CAREERS-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }
    public function destroy(Careers $careers)
    {
        try{
            if ($careers->delete()) {
                notify()->success(__('admin-dashboard.NOTIFY-DELETE-CAREERS-SUCCESS'),__('public.SUCCESS'));
                return redirect()->route('admins.categories-careers');
            }
        }catch (Exception $e){
            notify()->error(__('admin-dashboard.NOTIFY-DELETE-CAREERS-FAILED'),__('public.ERROR'));
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-DELETE-CAREERS-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80',
        ]);
    }

}
