<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Filters\User\UserFilter;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\FilterUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\UseCases\User\CreateUserCase;
use App\UseCases\User\UpdateUserCase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(FilterUserRequest $request, UserFilter $filter): View
    {
        $name = $request->name;
        $email = $request->email;
        $users = User::filter($filter)->orderBy('id', 'DESC')->paginate(self::PER_PAGE);

        return view('backend.user.index', [
            'users' => $users,
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function create(): View
    {
        $roles = Role::query()->pluck('name', 'id')->all();
        $user = new User();

        return view('backend.user.create', [
            'roles' => $roles,
            'user' => $user,
        ]);
    }

    public function store(CreateUserRequest $request, CreateUserCase $case): RedirectResponse
    {
        $data = $request->validated();
        $case->handle($data);

        return redirect('user')->with('flash_message', 'Пользователь успешно добавлен!');
    }

    public function edit(int $id): View
    {
        $user = User::query()->findOrFail($id);
        $roles = Role::query()->pluck('name', 'id')->all();

        return view('backend.user.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(int $id, UpdateUserRequest $request, UpdateUserCase $case): RedirectResponse
    {
        $data = $request->validated();
        $case->handle($id, $data);

        return redirect('user')->with('flash_message', 'Пользователь успешно отредактирован!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $userId = Auth::user()?->id;
        if ($id === $userId) {
            return redirect('user')->with('alert', 'Вы не можете удалить самого себя');
        }
        User::destroy($id);

        return redirect('user')->with('flash_message', 'Пользователь удален!');
    }
}
