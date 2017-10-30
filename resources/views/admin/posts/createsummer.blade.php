

<h1>Create Post</h1>

<div class="row">
{!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@summernote', 'files'=>true]) !!}

	<div class="form-group">
		{!! Form::label('title', 'Title:') !!}
		{!! Form::text('title', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('photo', 'Photo:') !!}
		{!! Form::file('photo', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		{!! Form::label('body', 'Content:') !!}
		{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
	</div>	

	<div class="form-group">
		<div id="summernote" type="textarea" name="body_summer">Hello Summernote</div>
	</div>	

	<div class="form-group">
		{!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
	</div>

{!! Form::close() !!}
</div>
<div class="row">
	{{-- @include('includes.form-error') --}}
</div>
@include('includes.summernote')
<script>$(document).ready(function() {
  $('#summernote').summernote();
});</script>