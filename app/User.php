<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // 見に行くモデル名, 見に行くテーブル名, 自分のid, 取得しに行くid
    public function favorites(){
        return $this->belongsToMany(Review::class, 'favorites', 'user_id', 'review_id')->withTimestamps();
    }

    // お気に入り登録する
    public function favorite($reviewId){
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favorites($reviewId);

        // 相手が自分自信でないかの確認
        // $its_me = $this->id == $reviewId;

        if ($exist) {
            // 既にお気に入り登録していれば何もしない
            return false;
        } else {
            // まだお気に入りしていなかったら登録する
            $this->favorites()->attach($reviewId);
            return true;
        }
    }

    // お気に入り外す
    public function unfavorite($reviewId){
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favorites($reviewId);

        // 相手が自分自身ではないかの確認
        // $its_me = $this->id == $userId;
    
        if ($exist) {
            // 既にお気に入り登録していればお気に入りから外す
            $this->favorites()->detach($reviewId);
            return true;
        } else {
            // まだお気に入り登録していなければ何もしない
            return false;
        }
    }

    // お気に入り登録している？
    public function is_favorites($reviewId){
        
        return $this->favorites()->where('review_id', $reviewId)->exists();
    }
}
