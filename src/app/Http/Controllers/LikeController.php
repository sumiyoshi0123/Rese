<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\Shop;
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
        return auth()->user()->likes;
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
        //
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