<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CountriesListService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', ['countries' => CountriesListService::getAll()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'tagline' => ['nullable', 'string', 'max:255'],
            'sex' => ['required', 'string', 'in:male,female,other'],
            'birthdate' => ['nullable', 'date'],
            'country' => ['nullable', 'string', 'max:2'],
            'about' => ['nullable', 'string'],
        ]);

        $user->update($request->all());

        return redirect()
            ->route('users.edit', ['user' => $user])
            ->with('message', 'Successfully saved changes.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
