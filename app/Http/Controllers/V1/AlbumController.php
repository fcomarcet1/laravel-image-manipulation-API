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
        $albums = Album::all();
        if ($albums->isEmpty()) {
            return response()->json([
                'message' => 'No albums found',
                'status' => 404
            ], 404);
        }
        // if we use the AlbumResource class, we can return the data in the following way
        return AlbumResource::collection(Album::paginate(10));
        //return response()->json(['data' => $albums,], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        // Album::create($request->all());
        $album = Album::create($request->validated());
        if (!$album) {
            return response('Album not created', 500);
        }
        return new AlbumResource($album);

        //return response($album, 200);

    }

    /**
     * Display the specified resource.
     *
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
        //return response()->json(['data' => $album,], 200);
        return new AlbumResource($album);
    }

    /**
     * Update the specified resource in storage.
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

        //return response()->json(['data' => $album,], 200);
        return new AlbumResource($album);
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
