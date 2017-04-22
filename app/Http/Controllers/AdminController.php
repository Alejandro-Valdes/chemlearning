<?php

namespace App\Http\Controllers;

use App\User;
use App\Role as Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Entrust;

class AdminController extends Controller
{
    public function index(){
    	$users = DB::table('users')->get();

    	$roles = DB::table('roles')->get();

    	$title = 'Usuarios registrados';

        if (!Entrust::hasRole('admin')) {
            return redirect('/');
        }

    	return view('admin.index')->withUsers($users)->withTitle($title)->withRoles($roles);

    }

    public function update(Request $request){
        $roles = DB::table('roles')->get();
        $title = 'Usuarios registrados';
        $users = DB::table('users')->get();

        if(!Role::find($request->rol)){
            return view('admin.index')->withUsers($users)->withTitle($title)->withRoles($roles)->withError('Selecciona un rol valido');
        }

    	$roleName = Role::find($request->rol)->name;
        
    	$user = User::find($request->id);
    	$newRole = Role::where('name', $roleName)->get()->first();

        $user->detachRoles($user->roles);
		$user->attachRole($newRole);

        if (!Entrust::hasRole('admin')) {
            return redirect('/');
        }

    	return view('admin.index')->withUsers($users)->withTitle($title)->withRoles($roles)->withMessage('Rol de ' . $user->name .  ' actualizado, nuevo rol: ' . $roleName);
    }
}
