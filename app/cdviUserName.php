<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cdviUserName extends Model
{
    protected $table = 'UserNames';

    protected $connection = 'events';

    protected $primaryKey = ['UserNameID'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['SiteNameID','UserID','LastName','FirstName','CompanyName','DepartmentName','Photo','Visitor'];

    public function user_group()
    {        
        return $this->hasOne('App\cdviUser', 'UserID', 'UserID');        
    }

}
