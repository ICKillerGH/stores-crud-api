<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate($request->query('per_page', 10));

        return $users;
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'paswword' => bcrypt($request->password)
        ]);

        return $user;
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
