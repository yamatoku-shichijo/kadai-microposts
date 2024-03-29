<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function index()                                       
    {                                                       
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10); 

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                        
            'users' => $users,                              
        ]);                                                 
    }                                                      
    
    public function show($id)                               
    {                                                   
        // idの値でユーザーを検索して収得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザの投稿一覧を作成日時の降順で収得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
            ]);
    } 
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション
     * 
     * @param $id ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function followings($id)
     {
        //  idの値でユーザを検索して収得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロー一覧を収得
        $followings = $user->followings()->paginate(10);
        
        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
     }
     
     /**
      * ユーザのフォロワー一覧ページを表示するアクション
      * 
      * @param $id ユーザのid
      * @return \Illuminate\Http\Response
      */
      public function followers($id) 
      {
        //   idの値でユーザを検索して収得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロワー一覧を収得
        $followers = $user->followers()->paginate(10);
        
        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
      }
      
      /**
       * ユーザのお気に入り一覧ページを表示するアクション
       * 
       * @param $micropost 投稿のid
       * @return \Illuminate\Http\Response
       */
       public function favorites($id)
       {
        //   idの値でユーザを検索して収得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのお気に入り一覧を収得
        $favorites = $user->favorites()->paginate(10);
        
        // お気に入り一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
            ]);
       }
}
