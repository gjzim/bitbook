<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use App\Services\CountriesListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('users.profile', [
            'user' => $user,
            'friendship' => auth()->user()->friendshipWith($user)->first(),
            'friendshipStatus' => auth()->user()->getFriendshipStatusWith($user),
        ]);
    }

    /**
     * Display the posts of a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function posts(Request $request, User $user)
    {
        if ($request->ajax()) {
            $posts = Post::with(['author', 'author.media', 'media'])
                ->withCount(['likes', 'comments'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->tap('add_liked_by_logged_in_user_attribute');

            return PostResource::Collection($posts);
        }

        return view('users.posts', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'countries' => CountriesListService::getAll(),
            'user' => $user,
        ]);
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
     * Mark all notifications of a user checked.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function checkAllUnreadNotifications(User $user)
    {
        $user->unreadNotifications()
            ->update([
                'checked' => true,
                'checked_at' => now(),
            ]);

        return redirect()->back()
            ->with('message', 'Successfully marked all notifications as read.');
    }

    /**
     * Show the confirmation form before deleting the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function confirmDelete(User $user)
    {
        return view('users.confirm-delete', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if (Auth::user()->id === $user->id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $user->clearMediaCollection('avatar');

        if ($user->delete()) {
            return redirect()->to('/')
                ->with('message', 'Your profile has successfully been deleted.');
        }

        return redirect()->back();
    }
}
