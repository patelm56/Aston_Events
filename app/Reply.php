<?php

namespace App;

use App\Reply;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
   protected $guarded = [];
   
   protected $appends = ['favoritesCount','isFavorited'];
   protected $with = ['owner'];

   protected static function boot()
   {
       parent::boot();

       static::deleting(function($reply) { // before delete() method call this
           $reply->favorites()->delete();
      });
   }

   public function owner()
   {
   		return $this->belongsTo(User::class, 'user_id');
   }

   public function event()
   {
      return $this->belongsTo(Event::class);
   }

   public function favorites()
   {
   		return $this->morphMany(Favorite::class,'favorited');
   }

   public function favorite()
   {
       $attributes = ['user_id' => auth()->id()]; 

       if(! $this->favorites()->where($attributes)->exists())
       {
    	   return $this->favorites()->create($attributes);
   		 }
    }

    public function unfavorite()
    {
        $attributes = ['user_id' => auth()->id()]; 
        
        $this->favorites()->where($attributes)->delete();

    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function isFavorited()
    {
      return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}