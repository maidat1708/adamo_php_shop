<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private UserService $service;
    public function __construct(UserService $service){
        $this->service = $service;
    }

    public function index()
    {
        //
        return view("auths.login.login");
    }

    public function login(Request $request){
        if(Auth::check()){
            return view("welcome");
        }
        $field = $request->validate([
            "phoneNumber" => ['required'],
            "password" => ["required"],
        ]);
        if (Auth::attempt(["phone_number" => $field['phoneNumber'], "password" => $field['password']])) {
            $request->session()->regenerate();
            return ;
        }
        return redirect('/');
    }

    public function register(RegisterRequest $request)
    {
        $field = $request->validated();
        $field['password'] = bcrypt($request->password);
        $addUser = $this->service->addUser($field);
        auth()->login($addUser);
        return view("welcome");
    }

    public function showRegister()
    {
        return view('auths.register.register');
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
