<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\Categorie;
use App\Models\Mregister;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{
    public function index(Request $req){
        $reg=Register::all();
         return view('total_user',compact('reg'));
    }
    public function activeuser(Request $req){
        // $u=DB::select('SELECT *
        // FROM registers
        // INNER JOIN userdetails
        // ON registers.id=userdetails.user_id AND userdetails.plan_status="1";');
        // dd($u[0]->full_name);

        $users = DB::table('registers')
            ->join('userdetails', 'registers.id', '=', 'userdetails.user_id')
            ->select('registers.*','userdetails.*')->where('userdetails.plan_status','1')
            ->get();
            

           return view('activeuser',compact('users'));
    }
    public function inactiveuser(Request $req){
        // $u=DB::select('SELECT *
        // FROM registers
        // INNER JOIN userdetails
        // ON registers.id=userdetails.user_id AND userdetails.plan_status="1";');
        // dd($u[0]->full_name);

        $users = DB::table('registers')
            ->join('userdetails', 'registers.id', '=', 'userdetails.user_id')
            ->select('registers.*','userdetails.*')->where('userdetails.plan_status','0')
            ->get();
            

           return view('inactiveuser',compact('users'));
    }
    public function transaction_history(Request $req){
        $users=DB::table('transactions')
        ->join('registers','registers.id','=','transactions.user_id')
        ->select('registers.full_name','transactions.*')
        ->get();
        return view('transactionHistory',compact('users'));
    }
    public function plans(Request $req){
        $users=DB::table('plans')
        ->get();
        return view('plans',compact('users'));
    }
    public function totalticket(Request $req){
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->get();
        return view('total_ticket',compact('users'));
    }
    public function raisedticket(Request $req){
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','1')->get();
        return view('raised_ticket',compact('users'));
    }
    public function processingticket(Request $req){
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','2')->get();
        return view('processing_ticket',compact('users'));
    }
    public function closedticket(Request $req){
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','3')->get();
        return view('closed_ticket',compact('users'));
    }
    public function createCategory(Request $req){
       return view('category');

    }
   
    public function totalmentor(Request $req){
        $user=Mregister::all();
        return view('total_mentors',compact('user'));
    }

}
