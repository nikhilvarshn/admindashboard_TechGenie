<?php

namespace App\Http\Controllers\Backend;
use Session;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Register;
use App\Models\Categorie;
use App\Models\Mregister;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class MainController extends Controller
{   
    public function index(Request $req){
        // if(session()->has('email')){return redirect('/activeuser');}
        $err=false;
        return view('adminlogin',compact('err'));
    }
    public function totaluser(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $reg=Register::all();
         return view('total_user',compact('reg'));
    }
    public function activeuser(Request $req){
        // $u=DB::select('SELECT *
        // FROM registers
        // INNER JOIN userdetails
        // ON registers.id=userdetails.user_id AND userdetails.plan_status="1";');
        // dd($u[0]->full_name);
        // if(!session()->has('email')){return redirect('/');}
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
        // if(!session()->has('email')){return redirect('/');}
        $users = DB::table('registers')
            ->join('userdetails', 'registers.id', '=', 'userdetails.user_id')
            ->select('registers.*','userdetails.*')->where('userdetails.plan_status','0')
            ->get();
            

           return view('inactiveuser',compact('users'));
    }
    public function transaction_history(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('transactions')
        ->join('registers','registers.id','=','transactions.user_id')
        ->select('registers.full_name','transactions.*')
        ->get();
        return view('transactionHistory',compact('users'));
    }
    public function plans(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('plans')
        ->get();
        return view('plans',compact('users'));
    }
    public function totalticket(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->get();
        return view('total_ticket',compact('users'));
    }
    public function raisedticket(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','1')->get();
        return view('raised_ticket',compact('users'));
    }
    public function processingticket(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','2')->get();
        return view('processing_ticket',compact('users'));
    }
    public function closedticket(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $users=DB::table('tickets')
        ->join('registers','registers.id','=','tickets.user_id')
        ->select('registers.*','tickets.*')->where('ticket_status','3')->get();
        return view('closed_ticket',compact('users'));
    }
    public function createCategory(Request $req){
        // if(!session()->has('email')){return redirect('/');}
       return view('category');

    }
   
    public function totalmentor(Request $req){
        // if(!session()->has('email')){return redirect('/');}
        $user=Mregister::all();
        return view('total_mentors',compact('user'));
    }
    public function adminlogin(Request $req){
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        
        $u=User::where('email',$req->email)->first();

        if($u){
            $p=Hash::check($req->password,$u->password);
            if($p){
                // dd("inside if");
                Session::put('email',$req->email);
               return redirect('/activeuser');
            }
            // dd("after if");
            $err=true;
            return Redirect::back()->withErrors(['msg' => 'The Message']);
            // return view('adminlogin',compact('err'));
            return back()->with('err',$err);
        }
        $err=true;
        // dd("after if");
        return Redirect::back()->withErrors(['msg' => 'The Message']);
        return back()->with('err',$err);
        // return view('adminlogin',compact('err'));
        // return 'email invalid';
    }
    public function logout(Request $req){
        //  dd(session()->all());
        
        // if(Session::get('email')){
        //     Session::pull('email');
        //     return redirect('/');
        // }        
        if(session()->has('email')){
            session()->pull('email');
            return redirect('/');
        }        
        return view('404');
    }

}
