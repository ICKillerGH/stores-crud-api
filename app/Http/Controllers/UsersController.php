<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate($request->query('per_page', 10));

        return UserResource::collection($users);
    }

    public function count()
    {
        return User::count();
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User($request->validated());
        $user->password = bcrypt($request->password);
        $user->save();

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(StoreUserRequest $request, User $user)
    {
        $user = $user->fill($request->safe()->except('password'));

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
