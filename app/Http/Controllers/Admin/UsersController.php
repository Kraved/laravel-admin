<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{

    /**
     * UsersController constructor.
     * Проверка пользователя на роль admin
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $data = app(User::class)->with('roles:name')->get();
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $data['user'] = app(User::class)->with('roles')->find($id);
        $data['roles'] = Role::all();
        return view('admin.users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if (isset($data['roles'])) {
            app(User::class)->swapRoles($data['userName'], $data['roles']);
        }

        $user = User::find($id);
        $result = $user->update($data);
        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'Данные пользователя успешно изменены']);
        } else {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка изменения данных пользователя']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $result = User::find($id)->delete();
        if ($result) {
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'Пользователь успешно удален']);
        } else {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка удаления пользователя']);
        }
    }
}
