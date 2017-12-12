@extends('layouts.admin')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<h1>Create Post</h1>

<div class="row">

{{-- {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!} --}}

{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true]) !!}

	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('category_id', 'Category:') !!}
		{!! Form::select('category_id', [''=>'Choose a category'] + $categories, null, ['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('photo', 'Post Image:') !!}
		{!! Form::file('photo', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('body', 'Content:') !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		<label for="tags">Tags:</label>
		<select id="tags" class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width:100%;">
		  	@foreach($tags as $tag)
		  		<option value={{ $tag->id }}>{{ $tag->name }}</option>
			@endforeach
		</select>
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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('js/select2.js')}}"></script>
@endsection

@stop