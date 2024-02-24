<?php

namespace App\Services;

use App\Http\Controllers\ImagesController;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserService {



    public function add($image) {
        DB::table('users')->insert(
            ['avatar' => $image->store('uploads') ]
        );
    }
}