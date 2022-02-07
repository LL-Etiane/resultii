<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Student;
use App\Models\Results;
use App\Models\Department;
use App\Models\Courses;
use App\Models\Payment;
use App\Models\Concour;
use App\Models\ConcourImage;

class ApiAdminController extends Controller
{
    //

    public function getUsers(){
        return response(User::all());
    }

    public function getPayments(){
        return response(Payment::all());
    }

    public function getresults(){
        return response(Concour::all());
    }

    public function postresults(Request $req){
        $concour = $req->post('concour');
        return Concour::create(['name'=>$concour]);
    }

    public function deleteconcour(Request $req){
        $id = $req->post('id');
        $concour = Concour::find($id);
        if($concour){
            return response($concour->delete());
        }else {
            return response("error",400);
        }
    }

    public function uploadconcourimage(Request $req){
        $validatedData = $req->validate([
            'concourId' => 'required',
            'image' => 'required'
        ]);

        $image = $req->file('image')->getClientOriginalName();
        $concour = Concour::find($req->post('concourId'));
        if($concour){
            $concourimage = new ConcourImage();
            $concourimage->image = $image;
            
            
            try {
                $concour->concourImage()->save($concourimage);
                $req->file('image')->move('concourimages',$image);
            } catch (\Throwable $th) {
                return response("error",400);
            }
            return response($concourimage);
        }else {
            return response("error",400);
        }

        return response("Okay");
    }
}
