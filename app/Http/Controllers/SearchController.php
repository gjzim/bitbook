<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $users = [];
        if ($searchQuery = $request->input('query')) {
            $users = User::with(['media'])
                ->where('name', 'like', "%{$searchQuery}%")
                ->orWhere('username', 'like', "%{$searchQuery}%")
                ->take(20)
                ->get();
        }

        return view('search.users', [
            'users' => $users,
            'searchQuery' => $searchQuery,
        ]);
    }
}
