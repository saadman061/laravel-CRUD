<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \GuzzleHttp\Client;
use App\Models\ToDoList;
use Yajra\Datatables\Datatables;

class ToDoListController extends Controller
{
    public function index() {

        return view('todolists/index');
             
    }

    public function getToDoList(Datatables $datatables) {
        $toDoLists =  ToDoList::all();
        return $datatables->of($toDoLists)->toJson();
    }


}
  