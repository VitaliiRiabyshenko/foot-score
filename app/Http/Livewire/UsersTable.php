<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
	use WithPagination;

	protected $paginationTheme = 'bootstrap';

	public $orderBy = 'id';

	public $orderAsc = true;

	public $perPage = 10;

	public $filters = [];

	public function setOrderField($field)
	{
		$this->orderBy = $field;
		$this->toggleOrderAsc();
	}

	public function toggleOrderAsc()
	{
		$this->orderAsc =! $this->orderAsc;
	}

	public function setPerPage($value)
	{
		$this->perPage = $value;
	}

	public function render()
	{
		$users = User::query()
			->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc');

		if(!empty($this->filters)) {
			foreach($this->filters as $key => $value) {
				if(empty($value)) {
					continue;
				}
				$users = $users->where($key, 'like', "%{$value}%");
			}
		}

		$users = $users->paginate($this->perPage);

		return view('livewire.users-table', compact('users'));
	}
}
