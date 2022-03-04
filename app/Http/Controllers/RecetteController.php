<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\User;
use App\Models\Recette;
use Session;

use Illuminate\Http\Request;

class RecetteController extends Controller
{
    public function addrecette(Request $request){
        $request->validate([
            'name' =>'required',
            'ingredient' =>'required',
            'etapes' =>'required'
        ]);
        $recette = new Recette();
        $recette->name=$request->name;
        $recette->ingredient=$request->ingredient;
        $recette->etapes=$request->etapes;
        if($request->hasfile('photo')){
            $file=$request->file('photo');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('images/',$filename);
            $recette->photo=$filename;
        }
        $res=$recette->save();
        if($res){
             return back()->with('success',"Recette ajouter avec success");
        }else{
         return back()->with('fail',"erreur d'ajout Recette");
        }
     }
     public function addrecettee(){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        return view("Admin.addrecette",compact('data'));
     }
     public function updaterecette(Request $request ){
        $recette = Recette::find($request->id);
        $recette->name=$request->name;
       $recette->ingredient=$request->ingredient;
       $recette->etapes=$request->etapes;
       if($request->hasfile('photo')){
           $destination='images/'.$recette->photo;
           if(File::exists($destination)){
               File::delete($destination);
           }
        
           $file=$request->file('photo');
           $extension=$file->getClientOriginalExtension();
           $filename=time().'.'.$extension;
           $file->move('images/',$filename);
           $recette->photo=$filename;
       }
       $recette->update();
        return redirect('allrecette')->with('success','bravoooooo');

    }
    public function updaterecettee($id){
        $data=array();
        if(Session::has('loginId')){
            $data=Admin::where('id','=',Session::get('loginId'))->first();
        }
        $recettes=Recette::where('id','=',$id)->get();
        return view("Admin.modifierrecette",compact('data','recettes'));
    }
    public function deleterecette($id){
        $supp=Recette::find($id);
        $supp->delete();
        return redirect('allrecette')->with('success','bravoooooo');
      }
}
