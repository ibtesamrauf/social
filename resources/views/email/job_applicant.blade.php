<!DOCTYPE html>
<html>
<head>
	<title>New Job Applicant</title>
</head>
<body>
	<h1>Hello {{ $marketer_data->first_name }} {{ $marketer_data->last_name }}</h1>
	<h2>You have new job applicant </h2>
	<table>
		<tr>
			<td>name: </td>
			<td>{{ $job_applicant->first_name }} {{ $job_applicant->last_name }}</td>
		</tr>
		<tr>
			<td>email: </td>
			<td>{{ $job_applicant->email }}</td>
		</tr>
	</table>
	<br>
	<br>
	<a href="{{ env('APP_URL', 'http://localhost') }}/job_post_resource_view_applicants/{{ $jobs->id }}">Click here to view Applicant</a>
</body>
</html>