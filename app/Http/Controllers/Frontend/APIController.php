<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Userdetail;
use App\Models\Plan;
use App\Models\Transaction;
use Carbon\Carbon;
class APIController extends Controller
{
    public function userdetails(Request $req){
        $req->validate([
            'user_id'=>'required',
            'mobile_no'=>'required',
            'coll_name'=>'required',
            'course_name'=>'required',
            'dob'=>'required',
            'gender'=>'required',
            'plan_id'=>'required',
            'purchase_date'=>'required',
            'expire_date'=>'required',
            'plan_status'=>'required'
        ]);
        $fuser=Userdetail::where('user_id',$req->user_id)->first();
        $ah=$fuser?$fuser->plan_status:'0';
        if($ah!="1"){
        $plan=Plan::where('plan_id',$req->plan_id)->first();
        $da=$plan->plan_duration;
        // $intn=(int)$da;
        $nnc=Carbon::now();
        $intn=intval($da);
        $vv=Carbon::now()->format('d-m-y');
        $cudate=Carbon::createFromFormat('d-m-y',$vv);
        $exdate=$cudate->addDays($intn);
        $userdetail=Userdetail::updateOrCreate(
            [ 
                'user_id'=>$req->user_id,
                'mobile_no'=>$req->mobile_no,
                'coll_name'=>$req->coll_name,
                'course_name'=>$req->course_name,
                'dob'=>$req->dob,
                'gender'=>$req->gender
            ],
            [
                'plan_id'=>$req->plan_id,
                'purchase_date'=>$nnc,
                'expire_date'=>$exdate,
                'plan_status'=>'1'
            ]
            );
            if($userdetail){
            $transaction=Transaction::create(
                [
                    'user_id'=>$req->user_id,
                    'plan_id'=>$req->plan_id,
                    'purchase_date'=>$nnc,
                    'expire_date'=>$exdate,
                ]
                );
            return response()->json(
                [
                    'msg'=>'plan purchase successfully!',
                    'data'=>$userdetail,
                    'status'=>true,
                    'error'=>false
                ]
                );
            }
            return response()->json(
                [
                    'msg'=>'please enter valid details!',
                    'data'=>[],
                    'status'=>true,
                    'error'=>true
                ]
                );
            }
            return response()->json(
                [
                    'msg'=>'Sorry, your plan is an active!',
                    'data'=>$fuser,
                    'status'=>true,
                    'error'=>true
                ]
                );

    }
    public function finduserdetail(Request $req){
        $req->validate([
            'user_id'=>'required',
        ]);
        $user=Userdetail::where('user_id',$req->user_id)->first();
        if($user){
            return response()->json([
                'msg'=>'User find successfully!',
                'data'=>$user,
                'data_exist'=>true
            ]);
        }
        return response()->json([
            'msg'=>'User not found!',
            'data'=>$user,
            'data_exist'=>false
        ]);
    }
    public function checkdata(Request $req){
        $req->validate([
            'user_id'=>'required'
        ]);
        $user=Userdetail::where('user_id',$req->user_id)->where('plan_status','1')->first();
        if($user){
            $ex=$user->expire_date;
             $vv=Carbon::now();
            if($vv>$ex){
                $user->plan_status='0';
                $user->save();
                $tr=Transaction::where('user_id',$req->user_id)->where('plan_status','1')->first();
                if($tr){
                    $tr->plan_status='0';
                    $tr->save();
                }
                return response()->json([
                    'plan'=>'expire',
                    'data'=>'
                        <div class="col-12 d-flex align-items-center sin mt-3 iactive">
                        <a href="dashboard"><span style="margin-right:20px;"><i class="bi bi-speedometer"></i></span>Dashboard</a>
                    </div>
                    <div class="col-12 d-flex align-items-center sin mt-3 iiactive">
                        <a href="active_plan"><span style="margin-right:20px;"><i class="bi bi-bag-check"></i></span>Active Plan</a>
                    </div>
                    <div class="col-12 d-flex align-items-center sin mt-3 ivactive">
                        <a href="transaction_history"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-clock-history"></i></span>Transactions</a>
                    </div>
                    <div class="col-12 d-flex align-items-center sin mt-3">
                        <a href="contactus"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-question-circle"></i></span>Help</a>
                    </div>
                    <div class="col-12 d-flex align-items-center sin mt-3">
                        <a href="logout"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-box-arrow-left"></i></span>Logout</a>
                    </div>',
                    'plan_status'=>false    
                ]);
            }
            return response()->json([
                'plan'=>'not expire',
                'data'=>'
                <div class="col-12 d-flex align-items-center sin mt-3 iactive">
                <a href="dashboard"><span style="margin-right:20px;"><i class="bi bi-speedometer"></i></span>Dashboard</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3 iiactive">
                <a href="active_plan"><span style="margin-right:20px;"><i class="bi bi-bag-check"></i></span>Active Plan</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3 iiiactive">
                <a href="ticket_generate"><span style="margin-right:20px;"><i class="bi bi-ticket-perforated"></i></i></span>Ticket Generating</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3 ivactive">
                <a href="transaction_history"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-clock-history"></i></span>Transactions</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3">
                <a href="contactus"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-question-circle"></i></span>Help</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3">
                <a href="logout"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-box-arrow-left"></i></span>Logout</a>
            </div>',
                'plan_status'=>true    
            ]);
        }
        return response()->json([
            'plan'=>'expire',
            'data'=>'
                <div class="col-12 d-flex align-items-center sin mt-3 iactive">
                <a href="dashboard"><span style="margin-right:20px;"><i class="bi bi-speedometer"></i></span>Dashboard</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3 iiactive">
                <a href="active_plan"><span style="margin-right:20px;"><i class="bi bi-bag-check"></i></span>Active Plan</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3 ivactive">
                <a href="transaction_history"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-clock-history"></i></span>Transactions</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3">
                <a href="contactus"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-question-circle"></i></span>Help</a>
            </div>
            <div class="col-12 d-flex align-items-center sin mt-3">
                <a href="logout"><span style="margin-right:20px;text-overflow:ellipse"><i class="bi bi-box-arrow-left"></i></span>Logout</a>
            </div>',
            'plan_status'=>false    
        ]);

    }
    public function findplanstatus(Request $req){
        $req->validate([
            'user_id'=>'required'
        ]);
        $userdetail=Userdetail::where('user_id',$req->user_id)->where('plan_status','1')->first();
        if($userdetail){
            $cf=$userdetail->plan_id;
            $pl=Plan::where('plan_id',$userdetail->plan_id)->first();
            if($cf=='1')
            {    $m='6 Months';}
            if($cf=='2')
              {  $m='Yearly';}
            if($cf=='3')
                {$m='4 Years';}
                
            return response()->json([
                'card'=>'
                <div class="pr-table-wrapper" style="border:5px groove #90cbee;border-radius:5px;">
                <div class="pack-name" style="font-size: 2.2rem;letter-spacing:2px;font-weight:500;text-transform:uppercase;">'.$pl->plan_name.'</div>
                <div class="price font-rubik" style="font-size: 4.5rem;"><i class="bi bi-currency-rupee"></i>'.$pl->plan_price.'</sup></div>
                <div class="pack-rec font-rubik" style="font-size: 1.5rem;">'.$m.'</div>
                
                <img src="public/images/icon/38.svg" alt="img" class="icon">
                <div style="color:#90cbee;"><b>You have purchased it.</b></div>
                <div class="d-flex justify-content-center" style="text-align:left">
                <ul class="pr-feature">
                    <li>Live classes & recorded lectures</li>
                    <li>Learn 10+ skills</li>
                    <li>4 live doubt clearing session</li>
                    <li>24*7 support</li>
                    <li>Industry-recognized certification</li>
                </ul>
                </div>
                <div class="trial-text font-rubik my-3">From '.$userdetail->purchase_date.' To '.$userdetail->expire_date.' </div>
            </div> 
                '
            ]);
        }
        return response()->json([
            'card'=>'
                <div class="d-flex justify-content-center align-items-center py-3 px-3"><h3>Sorry, no active plan</h3></div>
            '
        ]);
    }
    // public function getuser(Request $req){
    //     $u=Register::all();
    //     if($u){

    //     }

    // }
}
