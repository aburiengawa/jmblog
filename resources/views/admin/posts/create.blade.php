<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.admin')
@section('content')

<h1>Create Post</h1>

<div class="row">
{{-- {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!} --}}
{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}

	<div class="form-group">

		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>	

{{-- 	<div class="form-group">
		{!! Form::label('category_id', 'Category:') !!}
		{!! Form::select('category_id', [''=>'Choose a category'] + $categories, null, ['class'=>'form-control']) !!}
	</div> --}}

{{-- 	<div class="form-group">
		{!! Form::label('photo', 'Photo:') !!}
		{!! Form::file('photo', null, ['class'=>'form-control']) !!}
	</div>	 --}}

	<div class="form-group">
		{!! Form::label('body', 'Content:') !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
	</div>

{!! Form::close() !!}
</div>
<div class="row">
	{{-- @include('includes.form-error') --}}
</div>
@include('includes.tinyeditor')
@stop