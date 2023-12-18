<?php

namespace App\Http\Controllers;

use App\Models\users;
use App\Models\Roles;
use App\Http\Requests\StoreusersRequest;
use App\Http\Requests\UpdateusersRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('access-admin');

        $users = users::all();
        $roles = Roles::all();
        
        return view('admin.index', compact('users', 'roles'));
    }

    public function invite()
    {
        return view('profile.invite');
    }

    public function sendInvite()
    {
        print("test");
        
        return view('profile.sendInvite');
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
    public function store(StoreusersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateusersRequest $request, users $users)
    {              
        $users->update([
            "role" => $request->role,
        ]);

        $users = users::all();

        return Redirect::route('admin.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(users $users)
    {
        //
    }
}
