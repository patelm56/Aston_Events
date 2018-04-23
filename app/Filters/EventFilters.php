<?php

namespace App\Filters;

use App\User;
use Carbon\Carbon;

class EventFilters extends Filters
{
	protected $filters = ['by','popular', 'past_events','upcoming_events'];

	protected function by($username)
	{
		$user = User::where('name', $username)->firstOrFail();

		return $this->builder->where('user_id' , $user->id);
	}

	protected function popular()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->orderBy('favorites_count','desc');
	}

	protected function past_events()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->where('due_date', '<', Carbon::now());
	}

	protected function upcoming_events()
	{
		$this->builder->getQuery()->orders = [];

		return $this->builder->where('due_date', '>', Carbon::now());
	}

}