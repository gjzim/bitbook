<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAvatarController extends Controller
{
    /**
     * Change the avatar image of the user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'avatar' => [
                    'mimes:jpg,bmp,png',
                    'min:25',
                    'max:5120'
                ],
            ],
            [
                'avatar.mimes' => 'Only .jpg, .bmp, and .png files are allowed.',
                'avatar.min' => 'Image size must be greater than 25KB.',
                'avatar.max' => 'Image size must be less than 5MB.',
            ]
        );

        $user->addMediaFromRequest('avatar')
            ->setFileName($request->avatar->hashName())
            ->toMediaCollection('avatar');

        return redirect()->route('users.edit', ['user' => $user])
            ->with('message', 'Successfully changed the avatar.');
    }
}
