<?php

namespace App\Http\Controllers;

use App\Models\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RegisteredController extends Controller
{
    public function index(){
        return view('registered');
    }

    public function getRegistered(){
        $data = Registered::latest()->get(); 
        return DataTables::of($data)
            ->addIndexColumn()  
            ->make(true);
    }
}
