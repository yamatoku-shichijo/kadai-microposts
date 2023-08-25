<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * 投稿をお気に入りに登録するアクション
     * 
     * @param $id micropostのid
     * @return \Illuminate\Http\Response
     */
     public function store($id)
     {
        //  認証済みユーザ(閲覧者)が、idの投稿をお気に入り登録
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクト
        return back();
     }
     
     /**
      * お気に入りを解除するアクション 
      *
      * @param $id micropostのid
      * @return \Illuminate\Http\Response
      */
      public function destroy($id)
      {
        //   認証済みユーザ(閲覧者)が、idの投稿を外す
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
      }
}
