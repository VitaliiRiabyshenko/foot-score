<div>
	<table class="table table-striped" id="example">
		<thead>
			<tr>
				<th></th>
				<th>
					<input wire:model="filters.name" type="text" class="form-control" placeholder="Search by name">
				</th>
				<th>
					<input wire:model="filters.email" type="text" class="form-control" placeholder="Search by email">
				</th>
				<th></th>
			</tr>
			<tr>
				<th scope="col" wire:click="setOrderField('id')">
					ID
					@if ($orderBy == 'id')
						@if ($orderAsc)
							<small class="fas fa-angle-up"></small>
						@else
							<small class="fas fa-angle-down"></small>
						@endif
					@endif
				</th>
				<th scope="col">Name</th>
				<th scope="col">Email</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(!empty($users) && $users->count())
				@foreach ($users as $user)
					<tr>
						<th scope="row">{{ $user->id }}</th>
						<td>{{ $user->name}}</td>
						<td>{{ $user->email}}</td>
						<td>
							<a href="javascript:;" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger{{ $user->id }}">{{ __('Delete') }}</a>
						</td>
						@include('admin.users.modal.delete')
					</tr>
				@endforeach
			@else
			<tr>
				<td colspan="10">There are no data.</td>
			</tr>
			@endif
		</tbody>
	</table>

	<div class="col-12 d-flex justify-content-between">
		<div class="btn-group dropup mb-3">
			<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Per page: {{ $perPage }}
			</button>
			<div class="dropdown-menu" >
				<a class="dropdown-item" wire:click="setPerPage(10)" role="button">10</a>
				<a class="dropdown-item" wire:click="setPerPage(25)" role="button">25</a>
				<a class="dropdown-item" wire:click="setPerPage(50)" role="button">50</a>
				<a class="dropdown-item" wire:click="setPerPage(100)" role="button">100</a>
			</div>
		</div>
		<div>
			{!! $users->links() !!}
		</div>
	</div>