<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;


class UserController extends Controller
{
    public function register(Request $request){
        $rules = [
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:6'
        ];
        $validator =Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token =$user->createToken('Personal Access Token')->plainTextToken;
        $response = ['user' => $user, 'token'=>$token];
        return response()->json($response,200);
        
     }
     public function login(Request $request){
         $rules=[
             'email'=>'required|email',
             'password'=>'required|min:6'
         ];
         $request->validate($rules);
         $user =User::where('email',$request->email)->first();
         if($user && Hash::check($request->password,$user->password)){
             $token =$user->createToken('Personal Access Token')->plainTextToken;
             $response=['user'=>$user,'token'=>$token];
             return response()->json($response, 200);
         }
         $response=['message'=>'Incorrect email or password'];
         return response()->json($response, 400);
        }

        public function updateuser(Request $request ){
            $user = Recette::find($request->id);
            $user->name=$request->name;
           $user->email=$request->email;
           $user->password=$request->password;
           $user->update();
            return redirect('alluser')->with('success','bravoooooo');
    
        }
        public function updateuserr($id){
            $data=array();
            if(Session::has('loginId')){
                $data=Admin::where('id','=',Session::get('loginId'))->first();
            }
            $users=User::where('id','=',$id)->get();
            return view("Admin.modifieruser",compact('data','users'));
        }
        public function deleteuser($id){
            $supp=User::find($id);
            $supp->delete();
            return redirect('alluser')->with('success','bravoooooo');
          }
        
    }
