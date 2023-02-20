<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Jetstream\DeleteUser;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        return ['users' => $users];
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit(Request $request)
    {
        $userId = $request->route('userId');

        $user = $this->userRepository->getUserById($userId);

        if (empty($user)) {
            return back();
        }

        return view('user.edit', ['user' => $user]);
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermissionTo('create users')) {
            return back();
        }

        $fortify = new CreateNewUser();

        $user = $fortify::create($request->all());
        return $this->userRepository->getAllUsers();
    }

    public function destroy(Request $request)
    {
        $userId = $request->route('userId');
        $user = $this->userRepository->getUserById(($userId));

        if (empty($user)) {
            return back();
        }

        DeleteUser::delete($user);

        return back();
    }
}
