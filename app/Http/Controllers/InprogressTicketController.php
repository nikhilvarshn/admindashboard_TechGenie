<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InprogressTicketController extends Controller
{
    public function index(request $req)
    {
        $users = DB::table('tickets')
            ->where('ticket_status', 2)
            ->get();
        return view('inprogress', compact('users'));
    }
}
