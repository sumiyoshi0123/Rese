<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->with(['shop.area', 'shop.category'])->get();

        return response()->json([
            'likes' => $likes
        ]);
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
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(like $like)
    {
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'message' => 'Like deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Like not found'
            ], 404);
        }
    }

    public function toggleLike(Request $request)
    {
        $user = Auth::user();
        $like = Like::where('user_id',$user->id)
            ->where('shop_id', $request->shop_id)->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Like Cancel']);
        } else {
            Like::create([
                'user_id' => $user->id,
                'shop_id' => $request->shop_id,
            ]);
            return response()->json(['message' => 'Like Record']);
        }
    }
}