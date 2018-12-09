<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cdviCard extends Model
{
    protected $table = 'Cards';

    protected $connection = 'sqlsrv';

    protected $primaryKey = ['Card_ID'];

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['Site','Family Number','Card Number','PIN Number','First Name','Last Name','Status','Start Date','End Date','Card Traced','Extended','Use Keypad','Access Level','Access Level2','Comments','Notes','Notas','Photo','Floor Group','UD Text 1a','UD Text 2a','UD Text 3a','UD Text 4a','UD Text 5a','UD Text 6a','UD Text 7a','UD Text 1b','UD Text 2b','UD Text 3b','UD Text 4b','UD Text 5b','UD Text 6b','UD Text 7b','UD Text 1c','UD Text 2c','UD Text 3c','UD Text 4c','UD Text 5c','UD Text 6c','UD Text 7c','UD Check 1','UD Check 2','UD Date 1','UD Date 2','Company Name','Antipassback Overide','Arm Enabled','Disarm Enabled','Location','Card Design 1','Card Design 2','Card Design 3','Card Design 4','Interlock Overide','Custom_UI','SendToOutbox','Description','UserID','LastAccess','LastAccessTime','CardNumHex','GroupAccessLevel','Access Level3','Access Level4','EnableCardTraced','NumDays','ShortName','Counter','Count','LocationParking','GaurdTour','DisableCard','DisableCardDays','EnableDualBadge'];

    protected $guarded = ['Card_ID'];
}
