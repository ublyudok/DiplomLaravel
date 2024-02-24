<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    function registerPage () {
        return view('page_register');
    }

    function users() {
        $user = DB::table('users')->select('*')->get();
        return view('users', ['users' => $user]);
    }

    function login() {
        return view('page_login');
    }

    function page_profile($id) {

        $user = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return view('page_profile', ['user' => $user]);
    }

    function security($id) {
        $user = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return view('security', ['users' => $user]);
    }

    function changeStatus($id) {
        $user = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return view('status', ['users' => $user]);
    }

    function media($id) {
        $user = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return view('media', ['users' => $user]);
    }

    function createUser() {
        return view('create_user');
    }

    function editUser($id) {

        $user = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return view('edit', ['users' => $user]);
    }
}