<?php

namespace App\Http\Controllers;

use App\Mail\requestAdvisers;
use App\Models\Advisers;
use App\Models\Califications;
use App\Models\Categories;
use App\Models\Events;
use App\Models\Requests;
use App\Models\Requestsview;
use App\Models\Students;
use App\Models\Students_has_teams;
use App\Models\Teams;
use App\Models\TeamsView;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class TeamsController extends Controller
{
    public function create(){
        if (session()->get('LoggedUser')->role == 0){
            return view('students._teams-panel',[   'categories' => Categories::all(),
                                                'events' => Events::all(),
                                                'advisers' => Advisers::all(),
                                                'teamsview' => TeamsView::where('StudentId','=',session()->get('LoggedUser')->id)->get(),
                                                'notifications' => Requestsview::where('fk_student','=',session()->get('LoggedUser')->id)->get()]);
        }else if(session()->get('LoggedUser')->role == 1){
            $query = DB::select('SELECT `teams`.id AS "TeamId", 
            `teams`.`name`,
            `teams`.`status`,
            `teams`.`vbo`,
            `teams`.`urldoc`,
            `teams`.`fk_adviser`,
            `teams`.`fk_categorie`,
            `teams`.`fk_event`,
            `teams`.`active_invitations`,
                `advisers`.`id` AS `AdviserId`, 
                `advisers`.`name` AS `Adviser`, 
                `events`.`id` AS `EventId`, 
                `events`.`name` AS `Event`, 
                `categories`.`id` AS `CategorieId`, 
                `categories`.`name` AS `Categorie`
                FROM `teams` 
                LEFT JOIN `advisers` ON `teams`.`fk_adviser` = `advisers`.`id` 
                LEFT JOIN `events` ON `teams`.`fk_event` = `events`.`id` 
                LEFT JOIN `categories` ON `teams`.`fk_categorie` = `categories`.`id`
                WHERE `teams`. `fk_adviser` ='.session()->get('LoggedUser')->id.';');
            return view('advisers._teams-panel',['teams' => $query,
                                                'notifications' => Requestsview::where('fk_adviser','=',session()->get('LoggedUser')->id)->get()]);
        }
    }

    public function viewTeam($id){
        if (session()->get('LoggedUser')->role == 0){
            return view('students._viewUpdate-panel',['notifications' => Requestsview::where('fk_student','=',session()->get('LoggedUser')->id)->get(),
                                                    'teamsview' => TeamsView::where('TeamId','=',$id)->get(),
                                                    'categories' => Categories::all(),
                                                    'advisers' => Advisers::all(),
                                                    'requestsnotify' =>Requestsview::whereNotNull('fk_adviser')->where('fk_team','=',$id)->first()]);
        }else if(session()->get('LoggedUser')->role == 1){
            return view('advisers._view-team',[ 'notifications' => Requestsview::where('fk_adviser','=',session()->get('LoggedUser')->id)->get(),
                                                'teamsview' => TeamsView::where('TeamId','=',$id)->get(),]);
        }                                            
    }

    public function store(Request $request){
        $this-> isValid($request); 

        $file = $request->file;
        $filename = time().'.'.$file->getClientOriginalExtension();
        if($request->file->move('documents',$filename)){
            $team = new Teams;
            $team->urldoc = $filename;
            $team->name = $request->name;
            $team->status = 1;
            $team->vbo = 0;
            $team->fk_categorie = $request->categorie;
            $team->fk_event = $request->event;
            $team->active_invitations = 1;
            if($team->save()){
                $students_teams = new Students_has_teams;
                $students_teams->fk_student = session()->get('LoggedUser')->id;
                $students_teams->fk_teams = $team->id;
                if($students_teams->save()){ 
                    $request->request->add(['idTeam' => $team->id]);
                    $adviser = $this->checkAdviser($request);
                    if($adviser){
                        notify()->success(__('students-dashboard.NOTIFY-REGISTER-TEAM-SUCCESS'),__('public.SUCCESS'));      
                        return redirect()->route('students.teams-create');    
                    }                
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-REGISTER-TEAM-FAILED'),__('public.ERROR'));
                    return redirect()->route('students.teams-create');
                }
                notify()->error(__('students-dashboard.NOTIFY-REGISTER-TEAM-FAILED'),__('public.ERROR'));
                return redirect()->route('students.teams-create');
            }
        }
        
    }

    public function update(Request $request){
        $this-> isValidforUpdate($request);
        $flag = false;
        $team = Teams::find($request->idTeam);
        if ($request->name != "") {
            $team->name = $request->name;
            $flag = true;
        }
        if($request->emailadviser != ""){
            $this->checkAdviser($request);
            $flag = true;
        }
        if ($team->fk_categorie != $request->categorie) {
            $team->fk_categorie = $request->categorie;
            $flag = true;
        }
        if ($request->file) {
            $file = $request->file;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $team->urldoc = $filename;
            $flag = true;
        }
        if($flag == true){
            if($team->save()){
                notify()->success(__('students-dashboard.NOTIFY-UPDATE-TEAM-SUCCESS'),__('public.SUCCESS'));
                return redirect()->route('students.teams-create');
            }else{
                notify()->error(__('students-dashboard.NOTIFY-UPDATE-TEAM-FAILED'),__('public.ERROR'));
                return redirect()->route('students.teams-create');
            }
        }
        notify()->error(__('students-dashboard.NOTIFY-UPDATE-TEAM-FAILED'),__('public.ERROR'));
        return redirect()->route('students.teams-create');
    }
    
    private function checkAdviser($request){
        
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
               return $adviser;
            }
        }else{
            $this->sendRequestAdviser($request,$adviser,null);
            return $adviser;
        }      
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
    
    public function sendRequestStudent(Request $request){
        if(!$this->requestAlreadyExist($request)){
            $student = Students::where('noctrl','=',$request->noctrl)->first();
            if($student){
                $team = Teams::find($request->idTeam);
                if($team->active_invitations <= 5){
                    $requestStudent = new Requests;
                    $requestStudent->requestdate = Carbon::now();
                    $requestStudent->fk_student = $student->id;
                    $requestStudent->fk_team = $team->id;
                    if($requestStudent->save()){
                        $team->active_invitations++;
                        if($team->save()){
                            return redirect()->route('students.teams-create');
                            notify()->success(__('students-dashboard.NOTIFY-REQUEST-SEND-SUCCESS'),__('public.SUCCESS'));      
                        }
                    }
                }
            }
        }
        notify()->error(__('students-dashboard.NOTIFY-R-S-FAILED-EXIST'),__('public.ERROR'));
        return redirect()->route('students.teams-create');
    }

    private function requestAlreadyExist($request){
        $hasteam = DB::table('students_has_teams')
            ->leftJoin('students', 'students_has_teams.fk_student', '=', 'students.id')
            ->where('fk_teams','=',$request->idTeam)
            ->where('noctrl','=',$request->noctrl)->first();
        $hasrequest = DB::table('requests')
            ->leftJoin('students', 'requests.fk_student', '=', 'students.id')
            ->where('noctrl','=',$request->noctrl)
            ->where('fk_team','=',$request->idTeam)->first();
        if( $hasteam||$hasrequest||$request->noctrl == session()->get('LoggedUser')->noctrl){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function updateRequest(Request $request){
        if($request->flag == 1){
            $students_teams = new Students_has_teams;
            $students_teams->fk_student = session()->get('LoggedUser')->id;
            $students_teams->fk_teams = $request->Teamid;
            if($students_teams->save()){
                $deleted = Requests::where('id', $request->id)->delete();
                if($deleted == 1){
                    $team = Teams::find($request->Teamid);
                    $update = $team->update(['status',$team->status++]);
                    if($update){
                        notify()->success(__('students-dashboard.NOTIFY-REQUEST-CONFIRMED'),__('public.SUCCESS'));
                        return redirect()->route('students.teams-create');
                    }else{
                        notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                        return redirect()->route('students.teams-create');
                    } 
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect()->route('students.teams-create');
                }
            }
        }else{
            $deleted = Requests::where('id', $request->id)->delete();
            if($deleted == 1){
                $team = Teams::find($request->Teamid);
                if($team != null){
                    if($team->save()){
                        notify()->success(__('students-dashboard.NOTIFY-REQUEST-REJECT'),__('public.SUCCESS'));
                        return redirect()->route('students.teams-create');
                    }
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect()->route('students.teams-create');
                }
            }else{
                notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                return redirect()->route('students.teams-create');
            }
        }
    }

    public function updateRequestAdviser(Request $request){
        if($request->flag == 1){
            $deleted = Requests::where('id', $request->id)->delete();
            if($deleted == 1){
                $team = Teams::find($request->Teamid);
                $team->fk_adviser = session()->get('LoggedUser')->id;
                $team->status = $team->status + 1;
                if ($team->save()) {
                    notify()->success(__('students-dashboard.NOTIFY-REQUEST-CONFIRMED'),__('public.SUCCESS'));
                    return redirect('/panel-a-teams');
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect('/panel-asesores');
                }
            }else{
                notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                return redirect('/panel-asesores');
            }
        }else{
            $deleted = Requests::where('id', $request->id)->delete();
            if($deleted == 1){
                if($team = Teams::find($request->TeamId)){
                    $team->fk_adviser = null;
                    if($team->save()){
                        notify()->success(__('students-dashboard.NOTIFY-REQUEST-REJECT'),__('public.SUCCESS'));
                        return redirect('/panel-asesores');
                    }
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect('/panel-asesores');
                }
            }else{
                notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                return redirect('/panel-asesores');
            }
        }
    }

    public function outofTeam(Request $request,$id){
        if(session()->get('LoggedUser')->role == 0){
            
            $count = count(DB::table('students_has_teams')
            ->where('fk_teams','=',$id)->get());
            $hasrequests = count(DB::table('requests')
            ->where('fk_team','=',$id)->get());

            if ($count < 2) {
                if($hasrequests > 0){
                    DB::table('requests')
                    ->where('fk_team','=',$id)->delete();
                }
                $deleted  = DB::table('students_has_teams')
                ->where('fk_teams','=',$id)
                ->where('fk_student','=',session()->get('LoggedUser')->id)->delete();
                DB::table('teams')->where('id', '=', $id)->delete();
            }else{
                $deleted  = DB::table('students_has_teams')
                ->where('fk_teams','=',$id)
                ->where('fk_student','=',session()->get('LoggedUser')->id)->delete();
            }
            if($deleted == 1){
                if($team = Teams::find($id)){
                    $team->active_invitations = $team->active_invitations - 1 ;
                    $team->status = $team->status - 1;
                    if($team->save() == true){
                        notify()->success(__('students-dashboard.NOTIFY-REQUEST-REJECT'),__('public.SUCCESS'));
                        return redirect()->route('students.teams-create');
                    }
                }else{
                    if($count < 2 ){
                        notify()->success(__('students-dashboard.NOTIFY-REQUEST-REJECT'),__('public.SUCCESS'));
                        return redirect()->route('students.teams-create');
                    }
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect()->route('students.teams-create');
                }
            }else{
                notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                return redirect()->route('students.teams-create');
            }   
        }else if(session()->get('LoggedUser')->role == 1){
            
            if($team = Teams::find($id)){          
                $team->fk_adviser = null;
                $team->vbo = 0;
                if($team->save()){
                    notify()->success(__('students-dashboard.NOTIFY-REQUEST-REJECT'),__('public.SUCCESS'));
                    return redirect('/panel-a-teams');
                }else{
                    notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                    return redirect('/panel-a-teams');
                }
            }else{
                notify()->error(__('students-dashboard.NOTIFY-R-C-FAILED'),__('public.ERROR'));
                return redirect('/panel-a-teams');
            }
        }
    }

    private function isValid(Request $request){
        $request->validate([
            'name' => 'required|max:80',
            'file' => 'required|mimes:pdf',
            'emailadviser' => 'required|email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
        ]);
    }

    private function isValidforUpdate(Request $request){
        $request->validate([
            'name' => 'max:80',
            'file' => 'mimes:pdf',
            'emailadviser' => 'email|regex:/^[a-zA-Z0-9._]+@toluca.tecnm.mx$/i',
        ]);
    }
}
