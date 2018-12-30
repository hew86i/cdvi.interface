<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cdviUser;
use App\cdviCard;
use App\cdviUserGroup;
use App\cdviEvent;
use App\cdviRecordName;
use App\cdviUserName;

use DB;
use DataTables;
use Response;

class DatatableController extends Controller
{
    // retrun view for displaying users
    public function getUsers()
    {
        // $groups = cdviUserGroup::all();
        $e = new cdviEvent;
        return view('datatables.users', ['event' => $e->get_today_all()]);
    }

    // return JSON of all users for datatable
    public function allUsers()
    {
   

        // $users = cdviUser::select(['UserID','FirstName','LastName', 'StartDate','EndDate']);

        $users = DB::table('Users')
                ->join('UserGroups', 'Users.UserGroupID', '=', 'UserGroups.ID')
                ->select('Users.UserID','Users.FirstName','Users.LastName', 'Users.StartDate','Users.EndDate','UserGroups.Name')
                ->get();


        // U::with(['user_group' =>function($q) {$q->select('Nom')->where('UserID', '=', 'user_group.ID');}])->get();
        
        // ->where('UserGroupID', 0);

        // VAZNO - 'd-m-Y H:i'

        return Datatables::of($users)
            ->addColumn('checkbox', function ($user) {
                    return '<input type="checkbox" id="'.$user->UserID.'" name="someCheckbox" />' ;
                }, 1)
            ->editColumn('StartDate', function ($user) {           
                return date('d-m-Y H:i', strtotime($user->StartDate) );
            })
            ->editColumn('EndDate', function ($user) {
                return date('d-m-Y H:i', strtotime($user->EndDate) );
            })
            ->addColumn('Groups', function ($user) {
                return $user->Name;
            })
            ->make(true);

           
    }

    public function updateDates()
    {

        // var_dump($_POST);

        $selected_id = (isset($_POST["id"]) && !empty($_POST["id"])) ? $_POST["id"] : [];
        $start_date = (isset($_POST["start_date"]) && !empty($_POST["start_date"])) ? $_POST["start_date"] : "2018-12-05 02:12:60";
        $end_date = (isset($_POST["end_date"]) && !empty($_POST["end_date"])) ? $_POST["end_date"] : "2018-12-05 02:12:60";

        // update user and card data
        foreach ($selected_id as $id) {
            cdviUser::where('UserID', intval($id))->update(['StartDate' => (string)$start_date, 'EndDate' => (string)$end_date]);
        }

        foreach ($selected_id as $id) {            
            cdviCard::where('UserID', intval($id))->update(['Start Date' => (string)$start_date, 'End Date' => (string)$end_date]);
        }
   
        $_POST = array();

        // return Response::json(array('id' => $selected_id, 'start_date' => $start_date, 'end_date' => $end_date));

    }

    public function getReports()
    {
       return view('datatables.reports');
    }

    public function allReports()
    {

        // $today_events = cdviEvent::with('user_info.user_group')->select('UserNameID')->distinct()
        // ->where('Event Type', 1280)
        // ->where('Field Time', '>',  date('Y-m-d 00:00:00'))->groupBy('UserNameID')->get();

        // App\cdviEvent::distinct()->where('Event Type', 1280)->where('Field Time', '>', now()->addDay(-1))->get(['UserNameID'])->count()

        // $u =DB::connection('events')->table('Events')->select([DB::raw('count(*) as c_p, UserNameID')])->where('Event Type', 1280)->where('Field Time', '>', '2018-12-28 00:00')->groupBy('UserNameID')->get()

        $u =DB::connection('events')->table('Events')->select(['UserNameID', DB::raw('max("Field Time") as time')])->distinct()->where('Event Type', 1280)->where('Field Time', '>', '2018-12-28')->get();

        $reports = cdviEvent::select(['Event ID','Field Time', 'UserNameID', 'Card Holder ID', 'Record Name ID'])
                select([DB::raw('UserNameID', max('Field Time'))])
                ->where('Event Type', 1280)
                ->where('Field Time', '>',  date('Y-m-28 00:00:00'))
                // ->groupBy('UserNameID')
                ->orderBy('Event ID')
                ->get();

                select(DB::raw('id_zbozi, max(id) as id'))

                // ->orderBy('Event ID')
                // >select([DB::RAW('DISTINCT(UserNameID)'), 'Event ID','Field Time','Card Holder ID', 'Record Name ID'])
      
        return Datatables::of($reports)
            ->editColumn('Field Time', function ($event) {           
                return date('d-m-Y H:i:s', strtotime($event['Field Time']) );
            })
            ->editColumn('UserNameID', function ($event) {
                $u = cdviUserName::select(['LastName','FirstName'])->where('UserNameID', $event['UserNameID'])->first();
                return $u["FirstName"] . " " . $u["LastName"];
            })  
            ->editColumn('Record Name ID', function ($event) {
                $r = cdviRecordName::select(['Name'])->where('Record Name ID', $event['Record Name ID'])->first();
                return $r["Name"];
            })      
            ->make(true);;

    }

}
