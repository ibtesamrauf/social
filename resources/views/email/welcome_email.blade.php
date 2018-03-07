<!DOCTYPE html>
<html>
<head>
	<title>Welcome Email</title>
</head>
<body>
	<h1 align="center">Hello {{ $user->first_name }} {{ $user->last_name }}</h1>
	<h2 align="center">Welcome to influencer portal</h2>
	<h2 align="center">You Default password is 
		<strong>{{ $password_variable }}</strong>
	</h2>
	<a href="{{ env('APP_URL', 'http://localhost') }}/messages_influencer">Click here to open indox</a>
</body>
</html>