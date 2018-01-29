@extends('layouts.admin')
@section('content')
<h1>Users</h1>
<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Created</th>
			<th>Role</th>
			<th>Verified</th>
		</tr>
	</thead>
	<tbody>
	@if($users)
		@foreach($users as $user)
		<tr>
			<td><a href="/users/edit/{{ $user->id }}">{{$user->name}}</a></td>
			<td>{{$user->email}}</td>
			<td>{{$user->created_at->diffForHumans()}}</td>
			<td>{{$user->role->name}}</td>
			<td>{{$user->verified ? "Yes" : "No"}}</td>
		</tr>
		@endforeach
	@endif
	</tbody>
</table>
<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$users->render()}}
	</div>
</div>
@stop