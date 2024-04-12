<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $reserve = Reserve::where('user_id', $user->id)->with('shop')->first();
        //ログインしているユーザーの予約情報とshopのデータを一緒に取得する

        return response()->json([
            'reserve' => $reserve
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
        $user = Auth::user();

        $reserve = [
            'user_id' => $user->id,
            'shop_id' => $request->shop_id,
            'date' => $request->date,
            'time' => $request->time,
            'number' => $request->number,
        ];
        Reserve::create($reserve);
        return response()->json([
            "message" => "Successfully    reserved" //予約完了
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        $reserve = Reserve::where('user_id', $user->id)->first();

        if ($reserve) {
            $reserve->delete();
            return response()->json([
                'message' => 'Reserve deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Reserve not found'
            ], 404);
        }
    }
}
