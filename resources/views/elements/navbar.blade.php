<nav class="navbar">
	<div>
		<a class="nav-link" href="/">Car Licitations</a>
		@if(auth()->check())
		&emsp;
		<a class="nav-link" href="/my_profile">My Profile</a>
		&emsp;
		<a class="nav-link" href="/create_licitation">Create Licitation</a>
		@endif
		@if(!auth()->check())
		&emsp;
		<a class="nav-link" href="/login">Log in</a>
		&emsp;
		<a class="nav-link" href="/register">Register</a>
		@endif
		@if(auth()->check())
		&emsp;
		<a class="nav-link" href="/logout">Log out</a>
		@endif
	</div>
</nav>