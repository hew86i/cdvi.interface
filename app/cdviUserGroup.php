<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cdviUserGroup extends Model
{
    protected $table = 'UserGroups';

    protected $connection = 'sqlsrv';

    protected $primaryKey = "ID";

    public $timestamps = false;

    protected $fillable = ['Name','Nom','Nombre','Comments','Notes','Notas','Visitor','VisitorGroupStatus','VisitingUserID','ScheduledDeparture','ArrivalTime','DepartureTime','ApplyAccessLevels','AccessLevel1','AccessLevel2','AccessLevel3','AccessLevel4','ApplyGroupSettings','DisableVCard','UnassignVCard','ReqSignOut','DefResponsible','Parking','ParkingCapacity','ParkingFullRly','ParkingStatus','HardPassback','HardPassback2','AlternateGroup'];

    protected $guarded = ['ID','SiteID'];

    public function cdvi_users()
    {

        return $this->hasMany('App\cdviUser', 'UserGroupID', 'ID');

    }
}
