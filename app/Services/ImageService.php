<?php

namespace App\Services;

use App\Http\Controllers\ImagesController;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageService {

    public function all() {
        $images = DB::table('users')->select('*')->get();
        $myImages =  $images->all();

        return  $myImages;
    }

    public function add($image) {
        DB::table('users')->insert(
            ['avatar' => $image->store('uploads')]
        );
    }


    public function one($id) {
        $image = DB::table('users')->select('*')->where('id', $id)->get()->first();

        return $image;
    }

    public function update($id, $newImage) {
        $image = DB::table('users')->select('*')->where('id', $id)->get()->first();
        Storage::delete($image->avatar);

        $name = $newImage->store('uploads');
        Session::put('HasUpdated', 'Профиль успешно обновлён!');
        DB::table('users')
            ->where('id', $id)
            ->update(['avatar' => $name]);
    }

    public function delete($id) {

        $image = $this->one($id);
        Storage::delete($image->image);

        DB::table('users')->where('id', $id)->delete();

    }

}