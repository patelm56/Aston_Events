<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    protected $appends = ['favoritesCount','isFavorited'];


    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('favoritesCount', function($builder){
            $builder->withCount('favorites');
        });
    }

    public function path()
    {
        return "/events/{$this->id}";
    }

    public function eventOrganiser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
//this will allow to add many photos to the event
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
//These can allow you to have more than 1 reply
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
//This will allows other users as well as the current ones to reply to the event
    public function inputReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
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
