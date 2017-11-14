@extends('layouts.admin')
@section('content')

<h1>Categories</h1>

<div class="col-sm-4">

{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}

{{-- {!! Form::open(['method'=>'POST']) !!} --}}

	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Create Category', ['class'=>'btn btn-primary']) !!}
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

	@if($categories)
		@foreach($categories as $category)
		<tr>
			<td>{{$category->id}}</td>
			<td><a href="">{{$category->name}}</a></td>
			<td><a href="/admin/categories/{{$category->id}}">EDIT</a></td>
			{{-- {!! Form::open(['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy']]) !!} --}}
			{{-- <input type="hidden" name="id" value="{{$category->id}}"> --}}
			{{-- <td>{!! Form::submit('DELETE', ['class'=>'btn btn-danger col-sm-6']) !!}</td> --}}
			{{-- {!! Form::close() !!} --}}
			{{-- <td><a href="{{route('admin.categories.edit', $category->id)}}">{{$category->name}}</a></td> --}}
			<td>{{$category->created_at ? $category->created_at->diffForHumans() : 'No date'}}</td>
		</tr>
		@endforeach
	@endif

		</tbody>
	</table>
</div>

@stop