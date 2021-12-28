<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Staff :: latest()->where('trash',0)->get();
        return view('admin.staff.index',[
            'all_data'=> $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photo')){
            $img = $request-> file('photo');
            $file_name=$this->randName($img);
            $img->move(public_path('media/staff/'),$file_name);
        }
        Staff::create([
            'name'    => $request-> name,
            'email'   => $request-> email,
            'cell'    => $request-> cell,
            'location'=> $request-> location,
            'gender'  => $request-> gender,
            'photo'   => $file_name,
        ]);
        return redirect()->route('staff.index')->with('success','Staff Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Staff::find($id);
        return view('admin.staff.show',[
            'staff_data' => $data
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Staff::find($id);
        return view('admin.staff.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=Staff:: findOrFail($id);
        $file_name='';
        if($request-> hasFile('new_photo')){
            $img = $request -> file('new_photo');
            $file_name= $this->randName($img);
            $img->move(public_path('media/staff/'),$file_name);
            if(file_exists('media/staff/'.$request-> old_photo)){
                unlink('media/staff/'.$request-> old_photo);
            }
        }
        else{
            $file_name= $request -> old_photo;
        }
        $data -> name = $request -> name;
        $data -> email = $request -> email;
        $data -> cell = $request -> cell;
        $data -> location = $request -> location;
        $data -> gender = $request -> gender;
        $data -> photo =$file_name;
        $data -> update();
        return redirect()->route('staff.index')->with('success', ' Data Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Staff::findOrFail($id);
        $delete_name=$data->name;
        $delete_photo=$data->photo;
        $data->delete();
        if(file_exists('media/staff/'.$delete_photo)){
            unlink('media/staff/'.$delete_photo);
        }
        return redirect()->route('staff.trash.all')->with('success', $delete_name.' Data Deleted');
    }

    //**trash system */
    public function trash($id)
    {
        $data=Staff::find($id);
        if($data->trash == false)
        {
            $data->trash=true;
            $msg = $data->name.' Send to trash successful';
        }
        else
        {
            $data->trash = false;
            $msg = $data->name.' Restored successful';
        }
        $data-> update();
        return redirect()->route('staff.index')->with('success', $msg);
    }
    /**
     * Trash Data Show
     */
    public function trashData()
    {
        $data = Staff::latest()->where('trash',1)->get();
        return view ('admin.staff.trash',[
            'all_data' => $data
        ]);
    }
    /**
     * Search
    */
    public function search(Request $request){
       $search= $request->search;
       $data=Staff::latest('name','LIKE','%'.$search.'%')->orWhere('email','LIKE','%'.$search.'%')->orWhere('cell','LIKE','%'.$search.'%')->orWhere('location','LIKE','%'.$search.'%')->orWhere('gender','LIKE','%'.$search.'%')->get();
       return view('admin.staff.index',[
           'all_data' => $data
       ]);
    }
}
