<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cdviUser extends Model
{
    protected $table = 'Users';

    protected $connection = 'sqlsrv';

    protected $primaryKey = "UserID";

    public $timestamps = false;

    protected $fillable = ['FirstName','LastName','Status','StartDate','EndDate','Traced','Extended','Antipassback Overide','Interlock Overide','Photo','Company','Department','Address','City','State','Country','Phone1','Phone2','Phone3','EMail1','EMail2','EMail3','Comments','Notes','Notas','Location','LastAccess','LastAccessTime','Title','Initials','JobTitle','ZIP','UDText1a','UDText1b','UDText1c','UDText2a','UDText2b','UDText2c','UDText3a','UDText3b','UDText3c','UDText4a','UDText4b','UDText4c','UDText5a','UDText5b','UDText5c','UDText6a','UDText6b','UDText6c','UDText7a','UDText7b','UDText7c','UDText8a','UDText8b','UDText8c','UDText9a','UDText9b','UDText9c','UDText10a','UDText10b','UDText10c','UDText11a','UDText11b','UDText11c','UDText12a','UDText12b','UDText12c','UDCheck1','UDCheck2','UDCheck3','UDCheck4','UDDate1','UDDate2','UDDate3','UDDate4','UserGroupID','Picture','BadgeID','Signature','Visitor','VisitorStatus','VisitingUserID','ScheduledDeparture','BuisnessCard','LastAccessParking','LastAccessTimeParking','LocationParking','GlobalID','MealPlanID'];

    protected $guarded = ['UserID','SiteID'];


    public function cdvi_cards()
    {

        return $this->hasMany('App\cdviCard', 'UserID', 'UserID');

    }

    public function user_group()
    {
        return $this->belongsTo('App\cdviUserGroup', 'UserGroupID');
    }

    // public function GroupName()
    // {
    //     return $this->belongsTo('App\cdviUserGroup','UserGroupID', 'UserID')->select(array('Nom'));
    // }
    

}
