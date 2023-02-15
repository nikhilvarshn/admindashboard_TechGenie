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
                    'msg'=>'Data Inserted Successfully!',
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
}
