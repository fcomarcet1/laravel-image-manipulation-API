<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AlbumResource;
use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     **/
    public function index()
    {

        return AlbumResource::collection(Album::paginate());
        /*$albums = Album::all();
        if (!$albums) {
            //return $albums->toJson(JSON_PRETTY_PRINT);
            return response()->json([
                'data' => [],
                'message' => 'No albums found'
            ], 404);
        }

        // if we use the AlbumResource class, we can return the data in the following way
        return response(AlbumResource::collection($albums), 200);
        //return response()->json(['data' => $albums,], 200);*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request)
    {
        //var_dump($request->all()); die();
        // Album::create($request->all());
        $album = Album::create($request->validated());
        if (!$album) {
            return response('Album not created', 500);
        }
        return response($album, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        //return response($album, 200);
        $album = Album::find($id);
        //$album = Album::findOrFail((int) $id); // return 404 if not found
        if (!$album) {
            return response()->json([
                'data' => [],
                'message' => 'Album not found'
            ], 404);
        }
        return response()->json([
            'data' => $album,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAlbumRequest $request, string $id)
    {
        $album = Album::find((int)$id);
        if (!$album) {
            return response()->json([
                'data' => [],
                'message' => 'Album not found'
            ], 500);
        }
        $album->update($request->validated());

        return response()->json([
            'data' => $album,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        $album = Album::find((int)$id);
        if (!$album) {
            return response()->json([
                'data' => [],
                'message' => 'Album not found'
            ], 500);
        }
        $album->delete();

        return response()->json([
            'data' => [],
            'message' => sprintf('Album with id:%s is deleted', $id)
        ], 204);
    }
}
