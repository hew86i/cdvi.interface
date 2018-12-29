<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cdviRecordName extends Model
{
    protected $table = 'Record Names';

    protected $connection = 'events';

    protected $primaryKey = ['Record Name ID'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['Site Name ID','Name','Nom','Nombre','Record Type','Address','Display'];

    // protected $guarded = ['Card_ID'];

    
}
