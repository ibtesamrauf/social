<!DOCTYPE html>
<html>
<head>
	<title>New message email</title>
</head>
<body>
	<h1>Hello {{ $user->first_name }} {{ $user->last_name }}</h1>
	<h2>You have new message from {{ $admin->first_name }} {{ $admin->last_name }}</h2>
	<a href="{{ env('APP_URL', 'http://localhost') }}/messages_influencer">Click here to open indox</a>
</body>
</html>