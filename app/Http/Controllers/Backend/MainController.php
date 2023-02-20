<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function totaluser(Request $req){
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
}
