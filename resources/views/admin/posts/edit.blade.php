@extends('layouts.admin')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<h1>Edit Post</h1>

<div class="row">

	<div class="col-sm-3">
		<img src="{{$post->photo ? '/photos/shares/' . $post->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-responsive">
	</div>

	<div class="col-sm-9">

	{!! Form::model($post, ['route' => ['update', $post->id], 'method' => 'PATCH', 'files'=>true]) !!}

		<div class="form-group">
			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', null, ['class'=>'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('subheading', 'Subheading:') !!}
			{!! Form::text('subheading', null, ['class'=>'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('category_id', 'Category:') !!}
			{!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
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
				{!! Form::label('tags', 'Tags:') !!}
				{!! Form::select('tags[]', $tagArr, null, ['class'=>'form-control js-example-basic-multiple', 'multiple' => 'multiple']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Update Post', ['class'=>'btn btn-primary col-sm-6']) !!}
		</div>

	{!! Form::close() !!}

	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
	
		<div class="form-group">
			{!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-sm-6']) !!}
		</div>

	{!! Form::close() !!}
	</div>
</div>

{{-- <div class="row">
	@include('includes.form-error')
</div> --}}
@include('includes.tinyeditor')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('js/select2.js')}}"></script>
@endsection

@stop