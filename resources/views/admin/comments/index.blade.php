@extends('layouts.admin')
@section('content')
<h1>Comments</h1>
<table class="table">
	<thead>
		<tr>
			<th>User</th>
			<th>Comment</th>
			<th>Post Link</th>
			<th>Created</th>
			<th>Update</th>
		</tr>
	</thead>
	<tbody>
	@if($comments)
		@foreach($comments as $comment)
		<tr>
			<td>{{$comment->user->name}}</td>
			<td><a href="/comments/edit/{{ $comment->id }}">{!!str_limit($comment->body, 20)!!}</a></td>
			<td><a href="/post/{{ $comment->post->id }}">{{$comment->post->title}}</a></td>
			<td>{{$comment->created_at->diffForHumans()}}</td>
			<td>{{$comment->post->updated_at->diffForHumans()}}</td>
		</tr>
		@endforeach	
	@endif
	</tbody>
</table>
<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$comments->render()}}
	</div>
</div>
@stop