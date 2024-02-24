<?php

namespace App\Http\Controllers;

use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ImagesController extends Controller {

    private $images;
    public function __construct(ImageService $imageService) {
        $this->images = $imageService;
    }

    function store(Request $request) {
        $image = $request->file('avatar');
        $this->images->add($image);

        return redirect('/media');
    }

    function edit($id) {
        $image = $this->images->one($id);

        return view('media', ['imagesInView' => $image]);
    }

    function update(Request $request, $id) {
        $this->images->update($id, $request->avatar);
        return redirect('/');
    }

}