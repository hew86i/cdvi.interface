<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class cdviEvent extends Model
{
    protected $table = 'Events';
    
    protected $connection = 'events';

    protected $primaryKey = ['Event ID'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['Event Type','Data1','Data2','Field Time','Logged Time','Alarm','Operator ID','Card Holder ID','Record Name ID','Record Name ID (2)','Record Name ID (3)','Instruction ID','Site Name ID','Data3','Data4','UserNameID','DisplayEvent','Video','DVR_ID','DVR_Channel','VideoPreDelay','VideoPostDelay','CameraGUID'];

    public function user_info()
    {
        return $this->hasMany('App\cdviUserName', 'UserNameID', 'UserNameID');
    }

    public function get_today_all()
    {
        
        return $today_events = cdviEvent::with('user_info.user_group')
            ->select('UserNameID')->distinct()
            ->where('Event Type', 1280)
            ->where('Field Time', '>',  date('Y-m-d 00:00:00'))
            ->groupBy('UserNameID')
            ->get();
        
    //     // get user info
    //     $e->user_info()->first()->LastName;
    //     $e->user_info()->first()->FirstName;
        
    //     // get group ID
    //     $e->user_info->first()->user_group->UserGroupID;
        
    //     // $e[3]->user_info->first()->{"FirstName"}

    }

    public static function get_event_by_group($id)
    {
        // return cdviEvent::with(['user_info' => function ($query) {
        //     $query->with(['user_group' => function($q) {
        //             $q->where('UserGroupID', $id=2);
        //         }]);
        //     }])
        //     ->select('UserNameID')->distinct()->where('Event Type', 1280)
        //     ->where('Field Time', '>',  date('Y-m-d 00:00:00'))
        //     ->groupBy('UserNameID')->get();
        $e = new cdviEvent;
        return $e->get_today_all()->filter(function($grupa) {
            // $grupa->user_info->first()->user_group->UserGroupID) == $id
            if(intval($grupa->user_info->first()->user_group->UserGroupID) == 0)
            {
                return $grupa;
            }
            
        });
    }
}
