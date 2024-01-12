<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class users_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(userRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return $user;
    }


    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function fName(userRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->name = $validated['first_name'];

        $user->save();

        return $user;
    }

    public function lName(userRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->name = $validated['last_name'];

        $user->save();

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function email(userRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->email = $validated['email'];

        $user->save();

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function password(userRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();

        $user->password = Hash::make($validated['password']);

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $user;
    }
}
