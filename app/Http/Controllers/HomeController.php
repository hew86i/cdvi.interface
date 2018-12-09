<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Okipa\LaravelBootstrapTableList\TableList;
use App\cdviUser;

class HomeController extends Controller
{
    public function index()
    {

        return view('home');

    }

    public function users()
    {
                
        $table = app(TableList::class)
        ->setModel(cdviUser::class)
        ->setRoutes([
            'index' => ['alias' => 'users', 'parameters' => []],
        ])
        ->setRowsNumber(200)
        ->enableRowsNumberSelector();
        
        //we add some columns to the table list
        $table->addColumn('UserID')
            ->setTitle('USER ID')
            ->isSortable()
            ->isSearchable()
            ->sortByDefault()
            ->useForDestroyConfirmation();
        $table->addColumn('UserGroupID')
            ->setTitle('User Group')
            ->isCustomValue(function ($entity, $column) {
                return $entity->{$column->attribute};
            });
        $table->addColumn('FirstName')
            ->setTitle('First Name')
            ->isSearchable()
            ->setStringLimit(30);
        $table->addColumn('LastName')
            ->isSearchable()
            ->setTitle('Last Name')
            ->setStringLimit(30);


        return view('users')->with('table', $table);
    }



    public function cards()
    {

    }
}





