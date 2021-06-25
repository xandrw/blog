<?php

namespace App\Admin\Users\Http;

use App\Core\Http\Controllers\Controller;
use App\Users\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Factory;
use Illuminate\View\View;

class AdminUsersController extends Controller
{
    private Redirector $redirector;
    private Factory $viewFactory;

    public function __construct(Redirector $redirector, Factory $viewFactory)
    {
        $this->redirector = $redirector;
        $this->viewFactory = $viewFactory;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(Request $request): View
    {
        $this->authorize('read.users');

        $noCache = $request->headers->getCacheControlDirective('no-cache');

        if ($noCache) {
            Cache::forget('admin.users.index');
            $users = (new User)->orderBy('updated_at', 'desc')->paginate(14, ['id', 'name', 'email', 'created_at', 'updated_at']);
        } else {
            $users = Cache::remember('admin.users.index', 60, function() {
                return (new User)->orderBy('updated_at', 'desc')->paginate(14, ['id', 'name', 'email', 'created_at', 'updated_at']);
            });
        }

        return $this->viewFactory->make('Admin\Users::index', compact('users'));
    }

    /**
     * @throws AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create.users');

        return $this->viewFactory->make('Admin\Users::create');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $this->authorize('create.users');

        $user = (new User)->fill($request->validated());

        if ($user->save()) {
            return $this->redirector->route('admin.users.index')->with('message', 'User created');
        }

        return $this->redirector->route('admin.users.index')->withErrors(['user' => 'Could not create user']);
    }

    /**
     * @throws ModelNotFoundException
     * @throws AuthorizationException
     */
    public function edit(int $id): View
    {
        $this->authorize('update.users', $id);

        $user = (new User)->findOrFail($id);

        return $this->viewFactory->make('Admin\Users::edit', compact('user'));
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        $this->authorize('update.users', $id);

        $user = (new User)->findOrFail($id);
        $user->fill($request->validated());

        if ($user->save()) {
            return $this->redirector->route('admin.users.index')->with('message', 'User updated');
        }

        return $this->redirector->route('admin.users.index')->withErrors(['user' => 'Could not update user']);
    }

    /**
     * @throws ModelNotFoundException
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('delete.users', $id);

        $userDeleted = (new User)->findOrFail($id)->delete();

        if (!$userDeleted) {
            return $this->redirector->route('admin.users.index')->withErrors(['user' => 'Could not delete user']);
        }

        return $this->redirector->route('admin.users.index')->with('message', 'User deleted');
    }
}
