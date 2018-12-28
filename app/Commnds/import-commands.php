<?php

// php artisan tinker
// commands file
// -----------------------------

// lista so hex i id  ---------------------------
// se potpolnuva od file so regex priprema
$data = [];

// format na $data:
// ex: ["hex" => '1FF12B', "id" => '0001']
// regex: ([A-Z0-9]{6})\s([0-9]{10})\s(\d{4})
// ["hex" => '$1', "id" => '$3'],
// -----------------------------------------------------------------------
$cards = [];
$users = [];
foreach($data as $card) {
    // extract family number and card number
    // echo $family_number = hexdec(substr($card["hex"], 0, 2)) . "-";
    $family_number = hexdec(substr($card["hex"], 0, 2));
    // echo $card_number = hexdec(substr($card["hex"], 2)) . PHP_EOL;
    $card_number = hexdec(substr($card["hex"], 2));

    //create user
    $u = factory(App\cdviUser::class)->create(['FirstName' => $card["id"], 'LastName' => $card["last"], 'UserGroupID' => $card["group"], 'Status' => 2]);
    array_push($users, $u);
    //create card
    array_push($cards, factory(App\cdviCard::class)->create(['Family Number' => $family_number, 'Card Number' => $card_number, 'UserID' => $u['UserID'], 'Status' => 3]));

}

// -------------------------------------------------------------------------

// $uu = factory(App\cdviUser::class)->create(['FirstName' => "SSSSS", 'UserGroupID' => 1])->each(function ($u) {
//     $u->cdvi_cards()->save(factory(App\cdviCard::class)->make(['Family Number' => 11, 'Card Number' => 12121, 'UserID' => $u['UserID']]));
// })

// $uuu = factory(App\cdviUser::class)->make(['FirstName' => "TTT", 'UserGroupID' => 1])->each(function ($u) {
//     echo $u['UserID'];
// })
// $c = factory(App\cdviCard::class)->create();