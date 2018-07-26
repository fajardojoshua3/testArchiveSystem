<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\data;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user('id');
        $logged = $id->id;
        $data = data::where('user_id','=',$logged)->get();
        $position = $id->position;
        if($position == 'intern'){        
        return view('home')->with('user',$id)->with('dato',$data);
        }
        else if($position == 'employee'){
            $myInterns = User::where('Person_of_Contact','=',$logged)->get();
            return view('employee')->with('interns',$myInterns);
        }
    }

    public function store(Request $req){
        //pag merong laman si Upload File//
        if(Auth::user()->position =='intern'){
        if($req->hasFile('zip')){
           //etong $files na to is request ky input type file na my name na zip ung $req nkuha sa param sa taas 
            $files = $req->file('zip');
            //ung auth nakuha naten kase ginamit naten sia dto Illuminate\Support\Facades\Auth;
            $id = Auth::user('id');

            $idOnly = $id->id;
            // return $req->zip->store('public.file');
            //ung filenam variable is ttransfer nia yung file sa public.file folder then un value nia is $files ung gnwa nateng var knina
            $filename = Storage::putFile('public.file',$files);
            //dto na tayo mg eeloquent parang as tinker lang
            $mymodel = new data;
            $mymodel->directory_path = $filename;
            $mymodel->user_id = $idOnly;
            $mymodel->save();

            return redirect('/home')->with("success","Upload Success");

            
        }
        else{
           return redirect('/home')->with("error","No File Selected");

        }
    }
    else if(Auth::user()->position =='employee'){
        if($req->hasFile('zip')){
            //etong $files na to is request ky input type file na my name na zip ung $req nkuha sa param sa taas 
             $files = $req->file('zip');
             //ung auth nakuha naten kase ginamit naten sia dto Illuminate\Support\Facades\Auth;
             $id = Auth::user('id');
 
             $idOnly = $id->id;
             // return $req->zip->store('public.file');
             //ung filenam variable is ttransfer nia yung file sa public.file folder then un value nia is $files ung gnwa nateng var knina
             $filename = Storage::putFile('public.file',$files);
             //dto na tayo mg eeloquent parang as tinker lang
             $mymodel = new data;
             $mymodel->directory_path = $filename;
             $mymodel->user_id = $idOnly;
             $mymodel->save();
 
             return redirect('/upload')->with("success","Upload Success");
 
             
         }
         else{
            return redirect('/upload')->with("error","No File Selected");
 
         }
    }

    }

    public function edit($ida){

        if(Auth::user()->position =='intern'){
            $id = Auth::user();
            $logged = $id->id;
            $data = data::find($ida);
            return view('update')->with('data',$data);
        }
        else if(Auth::user()->position =='employee'){
            $ids = User::find($ida);
            $idi = $ids->id;
            $files = data::where('user_id','=',$idi)->get();
            if($files==null){
                return redirect('/home');
            }
            else{
            return view('files')->with('files',$files)->with('id',$ids);
            }

        }

    }

    public function update(Request $request,$id){
        if(Auth::user()->position =='intern'){
            if($request->hasFile('zip')){
            $files = $request->file('zip');
            $filename = Storage::putFile('public.file',$files);
            $mymodel = data::find($id);
            $mymodel->directory_path = $filename;
            $mymodel->save();
             return redirect()->action('HomeController@edit',$id)->with("success","Upload Updated");
        }
        else{
           return redirect()->action('HomeController@edit',$id)->with("error","No File Selected");
            }
        }
        
    }

    public function destroy($id){
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

    public function show($id){
         $data = data::find($id);
         if($data == null){
            return redirect('/home')->with('error','File Has No Longer Available');
         }
         else{
            return view('delete')->with('data',$data);
         }
         
    }

    
}
