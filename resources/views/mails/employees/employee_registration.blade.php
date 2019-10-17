<!DOCTYPE html>
<html>
<head>
    <title>Creat Profile</title>
</head>
	<style>
		.btn{
			padding: 10px;
			border: 1px solid #000;
			border-radius: 2px;
			background-color: #eee;
			
		}
	</style>
<body>
<h2>Welcome to the site {{$data['name']}} </h2>
<br/>
Your registered email-id is {{$data['email']}}
<div>
	<a href="{{ $data['url'] }}" class="btn">Create Profile</a>
	
</div>

<p>If the Button doesnt work please copy and paste the link in your browser.</p>


<p>{{ $data['url'] }}</p>
</body>

</html>