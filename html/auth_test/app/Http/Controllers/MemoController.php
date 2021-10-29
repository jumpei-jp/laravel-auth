<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

//---------------------------------------
//以下より追加
//---------------------------------------
use App\Http\Requests\Memo\StoreMemoRequest;
use App\Http\Requests\Memo\UpdateMemoRequest;
use App\Http\Requests\Memo\DestroyMemoRequest;
use App\Http\Requests\Memo\ShowMemoRequest;
use Illuminate\Support\Facades\Auth;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'message' => [
                'user name'=> $user->name,
                'Authority'=> $user->is_admin,
            ],
            'details' => Memo::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemoRequest $request)
    {
        $auth_user = (int) "1"; //adminユーザはint(1)
        $user_auth = Auth::user()->is_admin; //ログインしてくるユーザの権限

        //認証されていないユーザだとエラーを返す。
        if ($user_auth !== $auth_user) {
            return response()->json([
                'success' => false,
                'message' => 'you need admin Authority to create'
            ]);
        }

        //バリデーションで問題が無ければ保存
        $memo = new Memo();
        $memo -> create([
            'user_id' => auth()->id(),
            'title' => $request['title'],
            'content'=> $request['content']
        ]);
    
        //jsonを返す。
        return response()->json([
            'success' => true,
            'message' => 'Insert success!',
            'details' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    //public function show(Memo $memo)
    public function show(ShowMemoRequest $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Show Success!',
            'details' => Memo::find($request['id'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    public function edit(Memo $memo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Memo $memo)
    public function update(UpdateMemoRequest $request)
    {
        $auth_user = (int) "1"; //adminユーザはint(1)
        $user_auth = Auth::user()->is_admin; //ログインしてくるユーザの権限

        //認証されていないユーザだとエラーを返す。
        if ($user_auth !== $auth_user) {
            return response()->json([
                'success' => false,
                'message' => 'you need admin Authority to update'
            ]);
        }

        //更新
        $memo = Memo::find($request['id']);
        $memo->update($request->all());

        //jsonで結果を返す。
        return response()->json([
            'success' => true,
            'mesage' => 'Update Success!',
            'details' => $request->all()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memo  $memo
     * @return \Illuminate\Http\Response
     */
    //public function destroy($id)
    public function destroy(DestroyMemoRequest $request)
    {

        $auth_user = (int) "1"; //adminユーザはint(1)
        $user_auth = Auth::user()->is_admin; //ログインしてくるユーザの権限

        //認証されていないユーザだとエラーを返す。
        if ($user_auth !== $auth_user) {
            return response()->json([
                'success' => false,
                'message' => 'you need admin Authority to destroy'
            ]);
        }

        // 問題なければDB更新
        $memo = Memo::find($request['id']);
        $memo->delete();

        // jsonで結果を返す
        return response()->json([
            'success' => true,
            'message' => 'Delete Success!',
            'details' => $memo
        ]);
    }
}
