<?php

namespace App\Http\Controllers\chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Helper;


class chatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            "title"=> "Chat"
        ];

        return view("chat.chat",['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $id)
    {
        $getUser = User::paginate(10);
        return $getUser;
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
    public function destroy(Request $request)
    {
        // sleep(1);
        Auth::logout();
        if(!Auth::check()){
            return response()->json(Helper::authResponse(true,"LogOut Successful..","",200));
        }else{
            return response()->json(Helper::authResponse(false,"something wen,t wrong..","",403));
        }
    }
}
