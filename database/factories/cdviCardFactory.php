<?php

use Faker\Generator as Faker;

$factory->define(App\cdviCard::class, function (Faker $faker, $options) {

    // $family_number = mt_rand(1,10000);
    // $card_number = mt_rand(1,10000);

    $family_number = (array_key_exists('Family Number', $options)) ? $options['Family Number'] : mt_rand(1,10000);
    $card_number = (array_key_exists('Card Number', $options)) ? $options['Card Number'] : mt_rand(1,10000);

    return [
        'Site' => 0,
        // 'Family Number' => mt_rand(1,10000),
        // 'Card Number' => mt_rand(1,10000),
        'Family Number' => $family_number,
        'Card Number' => $card_number,
        'PIN Number' => 0,
        'First Name' => '',
        'Last Name' => '',
        'Status' => 0,  // 4 za unasigned, 3 za Temporary
        'Start Date' => Carbon\Carbon::today()->toDateTimeString(),
        'End Date' => Carbon\Carbon::today()->addDay()->toDateTimeString(),
        'Card Traced' => DB::raw(0),
        'Extended' => DB::raw(0),
        'Use Keypad' => DB::raw(0),
        'Access Level' => 0,
        'Access Level2' => 1,
        'Comments' => '',
        'Notes' => '',
        'Notas' => '',
        'Photo' => '',
        'Floor Group' => -1,
        'UD Text 1a' => '',
        'UD Text 2a' => '',
        'UD Text 3a' => '',
        'UD Text 4a' => '',
        'UD Text 5a' => '',
        'UD Text 6a' => '',
        'UD Text 7a' => '',
        'UD Text 1b' => '',
        'UD Text 2b' => '',
        'UD Text 3b' => '',
        'UD Text 4b' => '',
        'UD Text 5b' => '',
        'UD Text 6b' => '',
        'UD Text 7b' => '',
        'UD Text 1c' => '',
        'UD Text 2c' => '',
        'UD Text 3c' => '',
        'UD Text 4c' => '',
        'UD Text 5c' => '',
        'UD Text 6c' => '',
        'UD Text 7c' => '',
        'UD Check 1' => DB::raw(0),
        'UD Check 2' => DB::raw(0),
        'UD Date 1' => '2018-10-08 00:00:00.000',
        'UD Date 2' => '2018-10-08 00:00:00.000',
        'Company Name' => '',
        'Antipassback Overide' => DB::raw(0),
        'Arm Enabled' => DB::raw(0),
        'Disarm Enabled' => DB::raw(0),
        'Location' => 0,
        'Card Design 1' => NULL,
        'Card Design 2' => NULL,
        'Card Design 3' => NULL,
        'Card Design 4' => NULL,
        'Interlock Overide' => DB::raw(0),
        'Custom_UI' => DB::raw(0),
        'SendToOutbox' => DB::raw(0),
        'Description' => '',
        // 'UserID' => function () {
        //     return factory(App\cdviUser::class)->create()->UserID;
        // },
        'UserID' => -1,
        'LastAccess' => -1,
        'LastAccessTime' => Carbon\Carbon::today()->toDateTimeString(),
        'CardNumHex' => strtoupper(str_pad(dechex($family_number).dechex($card_number),10,'0',STR_PAD_LEFT)),
        'GroupAccessLevel' => DB::raw(0),
        'Access Level3' => 1,
        'Access Level4' => 1,
        'EnableCardTraced' => DB::raw(0),
        'NumDays' => 30,
        'ShortName' => '',
        'Counter' => DB::raw(0),
        'Count' => 0,
        'LocationParking' => 0,
        'GaurdTour' => DB::raw(0),
        'DisableCard' => DB::raw(0),
        'DisableCardDays' => 0,
        'EnableDualBadge' => DB::raw(0)
    ];


});
