<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResizeImageRequest;
use App\Models\ImageManipulation;
use App\Http\Requests\StoreImageManipulationRequest;
use App\Http\Requests\UpdateImageManipulationRequest;
use Illuminate\Http\Client\Request;

class ImageManipulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageManipulationRequest $request)
    {
        //
    }

    /**
     * Resize an image resource.
     */
    public function resize(ResizeImageRequest $request)
    {
        //
    }

    /**
     * Get image resource by Album.
     */
    public function byAlbum(Request $request, string $id)
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(ImageManipulation $imageManipulation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ImageManipulation $imageManipulation)
    {
        //
    }
}
