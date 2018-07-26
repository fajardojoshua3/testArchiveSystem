<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class employee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $use = Auth::user();
        $user = Auth::user()->id;
        $userData = data::where('user_id','=',$user)->get();
        return view('employeeFiles')->with('data',$userData)->with('user',$use);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->position == "employee"){
            $exactFile = data::find($id);
            return view('employeeView')->with('file',$exactFile);
            }
            else{
                return redirect('/home');
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->position == 'employee'){
            $exactFile = data::find($id);
            return view('updateEmployeeFile')->with('success','File Selected')->with('file',$exactFile);
        } 
        else{
            return redirect('/home');
        }
        
        
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
        if(Auth::user()->position == 'employee'){
            $exactFile = data::find($id);
            if($request->hasFile('zip')){
            $files = $request->file('zip');
            $filename = Storage::putFile('public.file',$files);
            $mymodel = data::find($id);
            $mymodel->directory_path = $filename;
            $mymodel->save();
            return redirect()->action('employee@edit',$exactFile)->with('success','File Successfully Updated'); 
            }
            else{
            return redirect()->action('employee@edit',$exactFile)->with('error','No File Selected');   
            }
        }
        else{
            return redirect('/home');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->position == 'employee'){
            $data = data::find($id);
            if($data == null){
                return redirect('/home')->with('error','File Has Been Deleted');
            }
            else{
                $data->delete();    
                return redirect('/home')->with('success','File Deleted');
            }
        }
    }
}
