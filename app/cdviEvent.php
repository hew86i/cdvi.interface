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

    // protected $guarded = ['Card_ID'];
}
