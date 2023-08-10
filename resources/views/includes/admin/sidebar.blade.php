<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

		<li class="nav-header">ADMIN PANEL</li>
		<li class="nav-item">
			<a href="{{ route('admin.users.index') }}" class="nav-link">
				<i class="nav-icon fas fa-users"></i>
				<p>
					Users
					<span class="badge badge-info right">{{ $users->count() }}</span>
				</p>
			</a>
		</li>
	</ul>
</nav>