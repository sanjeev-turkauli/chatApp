<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Helper;



class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       
        sleep(5);
        $user = new User;$token = Str::random(40);
        if($request->hasFile("image")){$imageName = time().'.'.$request->image->extension();$request->image->move(public_path('images'), $imageName);$user->image = $imageName;}
        $user->name = $request->name;$user->email = $request->email;$user->token = $token;$user->password =  Hash::make($request->password);$query = $user->save();

        if($query){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $status = Helper::authResponse(true,"User Successfuly Created...","new",200);
            }
        }else{
                $status = Helper::authResponse(false,"something wen,t wrong","N/A",403);
        }
        return response()->json($status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        sleep(2);
        if($request->email != "" || $request->password != ""){
            if(Auth::attempt(["email"=> $request->email , "password" => $request->password])){
                $status = Helper::authResponse(true,"login Successfuly...","N/A",200);
            }else{
                $status = Helper::authResponse(false,"Invalid user credentials...","N/A",403);
            }
        }else{
            $status = Helper::authResponse(false,"Please Enter Valid Input...","N/A",403);
        }

        return response()->json($status);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}