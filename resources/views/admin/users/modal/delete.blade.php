<!-- Delete user modal window -->
<form action="{{ route('admin.users.destroy', ['id' => $user->id]) }}" method="POST">
	<div class="modal fade" id="modal-danger{{ $user->id }}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{ __('Delete user') }}</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Are you sure want to delete user: {{ $user->name }}?</p>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn" data-dismiss="modal">Close</button>
					
						@csrf
						@method('DELETE')
						<input type="hidden" id="" name="id">
						<button type="submit" class="btn btn-danger">Delete</button>
					
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</form>