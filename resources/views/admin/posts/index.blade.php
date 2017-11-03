@extends('layouts.admin')
@section('content')
<h1>Posts</h1>
<table class="table">
	<thead>
		<tr>

			<th>User</th>
			<th>Title</th>
			<th>Body</th>
			<th>Post link</th>
			<th>Comments</th>
			<th>Created</th>
			<th>Update</th>
		</tr>
	</thead>
	<tbody>
	@if($posts)
		@foreach($posts as $post)
	
		<tr>

			<td>{{$post->user->name}}</td>
			<td><a href="">{{$post->title}}</a></td>
			<td>{!!str_limit($post->body, 20)!!}</td>
			<td><a href="/post/{{ $post->id }}">View Post</a></td>
			<td><a href="">View Comments</a></td>
			<td>{{$post->created_at->diffForHumans()}}</td>
			<td>{{$post->updated_at->diffForHumans()}}</td>
		</tr>

		@endforeach
	@endif
	</tbody>
</table>
<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$posts->render()}}
	</div>
</div>
@stop