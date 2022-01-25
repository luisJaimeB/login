<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::paginate(3);
        return view('users.index', compact('users'));
    }


    public function create(){
        return view('users.create');
    }


    public function store(UserCreateRequest $request){

      /*   $request->validate([
            'name' => 'required|min:3|max:10',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
 */
        $user = User::create($request->only('name', 'username', 'email') + [
            'password' => bcrypt($request->input('password'))
        ]);
        return redirect()->route('users.show', $user->id)->with('success', 'usuario creado correctamente');
    }


    public function show(User $user){
        //$user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }


    public function edit(User $user){
        
        return view('users.edit', compact('user'));
    }


    public function update(UserEditRequest $request, User $user){
        
        $data = $request->only('name', 'username', 'email');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password);
        
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado satisfactoriamente');
    }


    public function destroy(User $user){
        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente');
    }
}
