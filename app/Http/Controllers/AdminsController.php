<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Advisers;
use App\Models\Careers;
use App\Models\Categories;
use App\Models\Evaluators;
use App\Models\EvaluatorsView;
use App\Models\Events;
use App\Models\Gender;
use App\Models\Items;
use App\Models\Students;
use App\Models\StudentsView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminsController extends Controller
{
    public function index()
    {
        return view('admin._panel');
    }

    public function CategoriesCareersView(){
        return view('admin._panel-categories&careers',[ 'categories' => Categories::all(),
                                                        'careers' => Careers::all()]);
    }

    public function eventsView(){
        return view('admin._panel-events',['events' => Events::where('fk_admin','=',session()->get('LoggedUser')->id)->get()]);
    }

    public function studentsView(){
        return view('admin._panel-students',[   'students' => StudentsView::all(),
                                                'gender' => Gender::all(),
                                                'careers' => Careers::all()]);
    }

    public function evaluationsView(){
        return view('admin._panel-evaluations',['items' => Items::all(),
                                                'categories' => Categories::all(),
                                                'evaluations' => DB::select("SELECT `evaluations`.*, `categories`.`name` as 'CatName' FROM `evaluations` LEFT JOIN `categories` ON `evaluations`.`fk_categorie` = `categories`.`id`;")]);
    }

    public function advisersView(){
        return view('admin._panel-advisers',['advisers' => Advisers::all(),]);
    }

    public function evaluatorsView(){
        return view('admin._panel-evaluators',[ 'evaluators' => EvaluatorsView::all(),
                                                'categories' => Categories::all(),
                                                'events' => Events::all()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function show(Admins $admins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function edit(Admins $admins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admins $admins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admins $admins)
    {
        //
    }
}
