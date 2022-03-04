<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\User;
use App\Models\Recette;


use Session;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function connect(){
        return view('Admin.connexion');
    }
    public function dashboard(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        return view("Admin.dashboard",compact('data'));
    }

    public function alladmin(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        $admin=Admin::all();
        return view("Admin.alladmin",compact('data','admin'));
    }
    public function alluser(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        $user=User::all();
        return view("Admin.alluser",compact('data','user'));
    }
    public function allrecette(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        $recette=Recette::all();
        return view("Admin.allrecette",compact('data','recette'));
    }
    public function connexion(Request $request){
        $request->validate([
            'email' =>'required|email',
            'password' =>'required|min:6|max:26'
        ]);
        $user=Admin::where('email','=',$request->email)->first();
        if($user){
            if($request->password=$user->password){
                $request->Session()->put('loginId',$user->id);
                
                return redirect('dashboard');
            }else{
                return back()->with('fail','password incorrect!');
            }
        }else{
            return back()->with('fail','email invalid !');
        }
    }
    public function logout(){
        if(Session::has('loginId')){
            Session()->forget('loginId');
            Session::flush();
            return redirect('/');
        }
     }

     public function addadminn(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        return view("Admin.addadmin",compact('data'));
     }
     public function addadmin(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:admins',
            'password' =>'required|min:6|max:26'
        ]);
        $admin = new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->password=$request->password;
        if($request->hasfile('photo')){
            $file=$request->file('photo');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/',$filename);
            $admin->photo=$filename;
        }
        $res=$admin->save();
        if($res){
             return back()->with('success',"admin ajouter avec success");
        }else{
         return back()->with('fail',"erreur d'ajout admin");
        }
     }

     public function adduser(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:admins',
            'password' =>'required|min:6|max:26'
        ]);
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $res=$user->save();
        if($res){
             return back()->with('success',"utilisateur ajouter avec success");
        }else{
         return back()->with('fail',"erreur d'ajout utilisateur");
        }
     }
     public function adduserr(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        return view("Admin.adduser",compact('data'));
     }

     public function updateadmin(Request $request ){
        $admin = Admin::find($request->id);
        $admin->name=$request->name;
       $admin->email=$request->email;
       $admin->password=$request->password;
       if($request->hasfile('photo')){
           $destination='images/'.$admin->photo;
           if(File::exists($destination)){
               File::delete($destination);
           }
        
           $file=$request->file('photo');
           $extension=$file->getClientOriginalExtension();
           $filename=time().'.'.$extension;
           $file->move('images/',$filename);
           $admin->photo=$filename;
       }
       $admin->update();
        return redirect('alladmin')->with('success','bravoooooo');

    }
    public function updateadminn($id){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        $admins=Admin::where('id','=',$id)->get();
        return view("Admin.modifieradmin",compact('data','admins'));
    }
    public function deleteadmin($id){
        $supp=Admin::find($id);
        $supp->delete();
        return redirect('alladmin')->with('success','bravoooooo');
      }
}
