<?php

namespace App\Http\Controllers;

use App\Models\inactiveuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\TabCompletion\Matcher\FunctionsMatcher;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class InactiveUserController extends Controller
{
    public function index()
    {
        return view('/inactiveuser');
    }

    public function getdata(){
        // $data = inactiveuser::where('status', 1)->get();
        $data = inactiveuser::latest()->where('status',1)->get();
        dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
