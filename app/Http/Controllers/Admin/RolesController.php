<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RolesController extends Controller
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
        $data = Role::all();
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $result = Role::create($data);
        if ($result) {
            return redirect()
                ->route('admin.roles.index')
                ->with(['success' => 'Группа успешно добавлена']);
        } else {
            return back()
                ->withErrors(['error' => 'Ошибка добавления группы'])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $data = Role::find($id);
        return view('admin.roles.edit', compact('data'));
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
        $result = Role::find($id)->update($data);
        if ($result) {
            return redirect()
                ->route('admin.roles.index')
                ->with(['success' => 'Группа успешно изменена']);
        } else {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка изменения группы']);
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
        $result = Role::find($id)->delete();
        if ($result) {
            return redirect()
                ->route('admin.roles.index')
                ->with(['success' => 'Группа успешно удалена']);
        } else {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Ошибка удаления группы']);
        }
    }
}
