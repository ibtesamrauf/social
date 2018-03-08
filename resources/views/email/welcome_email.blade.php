<!DOCTYPE html>
<html>
<head>
	<title>Welcome Email</title>
</head>
<body>
	<h1 align="center">Hello {{ $user->first_name }} {{ $user->last_name }}</h1>
	<h2 align="center">Welcome to influencer portal</h2>
	<p align="center">You Default password is 
		<strong>{{ $password_variable }}</strong>
	</p>
	<a href="{{ env('APP_URL', 'http://localhost') }}/">Click here to go to Influencer</a>
</body>
</html>