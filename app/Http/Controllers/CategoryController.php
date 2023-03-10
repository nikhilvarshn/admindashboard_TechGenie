<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('category');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['title'=>'required',
                                    'status'=>'required'
                                ]); 

        $category = Category::updateOrCreate(
                                    ['id' => $request->category_id],
                                    [
                                        'title' => ucwords($request->title),
                                        'status' => $request->status,
                                    ]
                                );       
        
        if($request->category_id){
            $msg = "Updated Successfully.";
        }
        else{
            $category = Category::find($category->id);
            $category->ctrid = "CTR-".$category->id;
            $category->save();
            $msg = "Added Successfully";
        }
        return response()->json(['msg'=>$msg]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Category::latest()->get();   
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row){
                $name = $row->status;
                if($name==1){
                    $icon='<div class="d-flex align-items-center text-success">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span style="color:#17a00e;">Active</span>
                                        </div>';
                }else{
                    $icon='<div class="d-flex align-items-center text-danger">	<i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
                                            <span style="color:#9E130D;">In-Active</span>
                                        </div>';
                }
                return $icon;
            })
            ->editColumn('updated_at', function($row){ 
                return \Carbon\Carbon::parse($row->updated_at)->diffForHumans();                     
            }) 
            ->addColumn('action', function($row){

                $btn = '<abbr title="Edit" style="margin:5px;cursor:pointer;" data-bs-toggle="tooltip" data-bs-placement="top"><a class="editcategory" data-id="'.$row->id.'" ><i class="fa fa-pencil"></i></a></abbr>';
                $btn = $btn.'<abbr style="margin:5px;color:red;cursor:pointer;" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top" ><a class="delcategory" data-id="'.$row->id.'"><i class="fa fa-trash-o" style="color:red;"></i></a></abbr>';

                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::find($id);  
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Category::find($id)->delete();
        return response()->json(['success'=>'Category deleted successfully.']);
    }
}
