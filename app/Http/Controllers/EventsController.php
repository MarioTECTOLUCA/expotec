<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function store(Request $request){
        $this->isValid($request);
        $image = $request->image;
        $filename = time().'.'.$image->getClientOriginalExtension();
        if($request->image->move('documents',$filename)){
            $event = new Events;
            $event->name = $request->name;
            $event->time = $request->time;
            $event->date = $request->date;
            $event->image = $filename;
            $event->status = 1;
            $event->fk_admin = session()->get('LoggedUser')->id;
            if ($event->save()) {
                notify()->success(__('admin-dashboard.NOTIFY-REGISTER-EVENT-SUCCESS'),__('public.SUCCESS'));      
                return redirect()->route('admins.events');
            }
        }
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-EVENT-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.events');
    }

    public function show($id){
        return view('components.private._update-events',['event' => Events::find($id)]);
    }

    public function update(Request $request,Events $event){
        $this->isValidforUpdate($request);
        $event->name = $request->name;
        $event->time = $request->time;
        $event->date = $request->date;
        if ($request->image) {
            $file = $request->image;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $event->image = $filename;
        }
        if($event->save()){
            notify()->success(__('admin-dashboard.NOTIFY-REGISTER-EVENT-SUCCESS'),__('public.SUCCESS'));      
            return redirect()->route('admins.events');
        }
        notify()->error(__('admin-dashboard.NOTIFY-REGISTER-EVENT-FAILED'),__('public.ERROR'));
        return redirect()->route('admins.events');
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80',
            'time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'image' => 'required|image',
        ]);
    }

    private function isValidforUpdate(Request $request){
        $request->validate([
            'name' => 'required|max:80',
            'date' => 'required|date',
            'image' => 'image',
        ]);
    }
}
