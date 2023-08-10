<?php

namespace App\Http\ViewComposers;


use Illuminate\View\View;
use App\Models\RapidApi\Country;

class SidebarComposer
{
	public function compose(View $view)
	{
		return $view->with(['countries' => Country::all()]);
	}
}