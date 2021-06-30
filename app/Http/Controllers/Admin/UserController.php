<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.user.index', [
            'users' => $this->getUsersArray($users),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles=\Spatie\Permission\Models\Role::get();
        return view('admin.user.edit',[
            'user' => $user,
            'roles'=>$roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->title;
        $user->email=$request->email;
        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->withSuccess('Пользователь был успешно обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->withSuccess('Пользователь был успешно удален!');
    }


    private function getUsersArray($users)
    {
        $arrayUsers = [];
        foreach ($users as $user) {

            $arrayRoles = $user->getRoleNames()->toArray();
            $user = $user->toArray();
            $user['updated_at'] = date('Y-m-d H:i:s', strtotime($user['updated_at']));
            $user['created_at'] = date('Y-m-d H:i:s', strtotime($user['created_at']));
            $user['roles'] = $arrayRoles;

            $arrayUsers[] = $user;
        }
        return $arrayUsers;
    }
}
