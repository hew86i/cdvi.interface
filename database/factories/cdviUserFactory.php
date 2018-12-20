<?php

use Faker\Generator as Faker;

$factory->define(App\cdviUser::class, function (Faker $faker, $options) {

    $first_name = (array_key_exists('FirstName', $options)) ? $options['FirstName'] : $faker->firstName($gender = 'male'|'female');
    $last_name = (array_key_exists('LastName', $options)) ? $options['LastName'] : $faker->lastName;

    return [
        'SiteID' => 0,
        'FirstName' => $first_name,
        'LastName' => $last_name,
        'Status' => 0,
        'StartDate' => Carbon\Carbon::today()->toDateTimeString(),
        'EndDate' => Carbon\Carbon::today()->addDay()->toDateTimeString(),
        'Traced' => DB::raw(0),
        'Extended' => DB::raw(0),
        'Antipassback Overide' => DB::raw(0),
        'Interlock Overide' => DB::raw(0),
        'Photo' => '',
        'Company' => 0,
        'Department' => 0,
        'Address' => '',
        'City' => '',
        'State' => '',
        'Country' => '',
        'Phone1' => '',
        'Phone2' => '',
        'Phone3' => '',
        'EMail1' => '',
        'EMail2' => '',
        'EMail3' => '',
        'Comments' => '',
        'Notes' => '',
        'Notas' => '',
        'Location' => 0,
        'LastAccess' => 0,
        'LastAccessTime' => Carbon\Carbon::now()->toDateTimeString(),
        'Title' => 0,
        'Initials' => '',
        'JobTitle' => 0,
        'ZIP' => '',
        'UDText1a' => '',
        'UDText1b' => '',
        'UDText1c' => '',
        'UDText2a' => '',
        'UDText2b' => '',
        'UDText2c' => '',
        'UDText3a' => '',
        'UDText3b' => '',
        'UDText3c' => '',
        'UDText4a' => '',
        'UDText4b' => '',
        'UDText4c' => '',
        'UDText5a' => '',
        'UDText5b' => '',
        'UDText5c' => '',
        'UDText6a' => '',
        'UDText6b' => '',
        'UDText6c' => '',
        'UDText7a' => '',
        'UDText7b' => '',
        'UDText7c' => '',
        'UDText8a' => '',
        'UDText8b' => '',
        'UDText8c' => '',
        'UDText9a' => '',
        'UDText9b' => '',
        'UDText9c' => '',
        'UDText10a' => '',
        'UDText10b' => '',
        'UDText10c' => '',
        'UDText11a' => '',
        'UDText11b' => '',
        'UDText11c' => '',
        'UDText12a' => '',
        'UDText12b' => '',
        'UDText12c' => '',
        'UDCheck1' => DB::raw(0),
        'UDCheck2' => DB::raw(0),
        'UDCheck3' => DB::raw(0),
        'UDCheck4' => DB::raw(0),
        'UDDate1' => '2018-09-24 00:00:00.000',
        'UDDate2' => '2018-09-24 00:00:00.000',
        'UDDate3' => '2018-09-24 00:00:00.000',
        'UDDate4' => '2018-09-24 00:00:00.000',
        'UserGroupID' => 0, // -1 za da ne se dodeli vo grupa
        'Picture' => NULL,
        'BadgeID' => -1,
        'Signature' => NULL,
        'Visitor' => DB::raw(0),
        'VisitorStatus' => 0,
        'VisitingUserID' => -1,
        'ScheduledDeparture' => DB::raw(0),
        'BuisnessCard' => NULL,
        'LastAccessParking' => -1,
        'LastAccessTimeParking' => '2018-09-24 23:11:37.000',
        'LocationParking' => 0,
        'GlobalID' => -1,
        'MealPlanID' => -1
    ];
});

/*  copy - paste for creating users

$users = [];
for($i=1; $i<=10; $i++) {
    $firstName = "Ednodenvna " . str_pad($i, 4, '0', STR_PAD_LEFT);;
    $lastName = "";
    // echo $firstName;
    array_push($users, factory(App\cdviUser::class)->create(['FirstName' => $firstName, 'LastName' => $lastName, 'UserGroupID' => 0]));
}

*/