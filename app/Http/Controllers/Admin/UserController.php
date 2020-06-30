<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = User::$roles;
        $genders = User::$genders;
        return view('admin.users.create', compact('userRoles', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->all());
        flash('Thêm mới tài khoản thành công!')->success();
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userRoles = User::$roles;
        $genders = User::$genders;
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'userRoles', 'genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUserRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUserRequest $request, int $id)
    {
        $this->userService->updateUser($request->all(), $id);
        flash('Cập nhật tài khoản thành công!')->success();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        flash('Xóa tài khoản thành công!')->success();
        return redirect()->route('admin.users.index');
    }

    /**
     * stop user
     *
     * @param $id
     * @return RedirectResponse
     */
    public function stop($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 2
        ]);
        return redirect()->back();
    }

    /**
     * active supplier
     *
     * @param $id
     * @return RedirectResponse
     */
    public function active($id)
    {
        $user = User::find($id);
        $user->update([
            'status' => 1
        ]);
        return redirect()->back();
    }
}
