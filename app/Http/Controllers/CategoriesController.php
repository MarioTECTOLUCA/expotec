<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->isValid($request);
        $categorie = new Categories();
        $categorie->name = $request->name;
        if($categorie->save()){
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-CATEGORIE-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-CATEGORIE-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }
    public function show(Categories $categories)
    {
        //
    }
    public function edit(Categories $categories)
    {
        //
    }
    public function update(Request $request)
    {
        $this->isValid($request);
        $categorie = Categories::find($request->id);
        $categorie->name = $request->name;
        if ($categorie->save()) {
            notify()->success(__('admin-dashboard.NOTIFY-UPDATE-CATEGORIE-SUCCESS'),__('public.SUCCESS'));
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-UPDATE-CATEGORIE-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }
    public function destroy(Categories $categories)
    {
        try{
            if ($categories->delete()) {
                notify()->success(__('admin-dashboard.NOTIFY-DELETE-CATEGORIE-SUCCESS'),__('public.SUCCESS'));
                return redirect()->route('admins.categories-careers');
            }
        }catch (Exception $e){
            notify()->error(__('admin-dashboard.NOTIFY-DELETE-CATEGORIE-FAILED'),__('public.ERROR'));
            return redirect()->route('admins.categories-careers');
        }
        notify()->error(__('admin-dashboard.NOTIFY-DELETE-CATEGORIE-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.categories-careers');
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80',
        ]);
    }
}
