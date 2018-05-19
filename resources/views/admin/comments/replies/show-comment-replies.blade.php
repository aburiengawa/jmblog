@extends('layouts.admin')
@section('content')
<h1>Replies</h1>
<table class="table">
	<thead>
		<tr>
			@if(Auth::user()->role_id === 1)
			<th>User</th>
			@endif
			<th>Reply</th>
			<th>Post Link</th>
			<th>Created</th>
			<th>Updated</th>
		</tr>
	</thead>
	<tbody>
	@if($replies)
		@foreach($replies as $reply)
		<tr>
			@if(Auth::user()->role_id === 1)
			<td>{{$reply->user->name}}</td>
			@endif
			<td><a href="/comments/edit/{{ $reply->id }}">{!!str_limit($reply->body, 20)!!}</a></td>
			<td><a href="/post/{{ $reply->comment->post->id }}">{{$reply->comment->post->title}}</a></td>
			<td>{{$reply->created_at->diffForHumans()}}</td>
			<td>{{$reply->updated_at->diffForHumans()}}</td>
		</tr>
		@endforeach	
	@endif
	</tbody>
</table>
<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$replies->render()}}
	</div>
</div>
@stop