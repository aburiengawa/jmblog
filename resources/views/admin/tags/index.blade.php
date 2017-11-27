@extends('layouts.admin')
@section('content')

<h1>Tags</h1>

<div class="col-sm-4">

{!! Form::open(['method'=>'POST', 'action'=>'TagsController@store']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Create Tag', ['class'=>'btn btn-primary']) !!}
	</div>

{!! Form::close() !!}

</div>

<div class="col-sm-8">
	<table class="table">
		<thead>
			<th>ID</th>
			<th>Name</th>
			<th>Action</th>
			<th>Created</th>
		</thead>
		<tbody>

	@if($tags)
		@foreach($tags as $tag)
		<tr>
			<td>{{$tag->id}}</td>
			<td><a href="/posts/tags/{{ $tag->id }}">{{$tag->name}}</a></td>
			<td><a href="/admin/tags/{{$tag->id}}">EDIT</a></td>
			<td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'No date'}}</td>
		</tr>
		@endforeach
	@endif

		</tbody>
	</table>
</div>

@stop