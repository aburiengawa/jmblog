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

	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id], 'id' => 'delete_form']) !!}
	{{-- <form method="DELETE" action="AdminPostsController@destroy" id="deleteform"> --}}
		<div class="form-group">
			<input type="submit" id="submit_delete" class="btn btn-danger col-sm-6" value="Delete Post" disabled="disabled"/>
			{{-- <button class="btn btn-danger col-sm-6">Delete Post</button> --}}
		</div>
	{{-- </form> --}}
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
	$("#delete_form").submit(function(event) {
		var form = this;
		event.preventDefault();
		swal({
  			title: "You sure about this?",
  			text: "Once deleted, you'll never get it back.",
  			icon: "warning",
  			buttons: ["Take me back...", "Yup!"],
  			dangerMode: true,
		}).then((willDelete) => {
			if(willDelete) {
				swal({
					text: "Cool beans!",
					icon: "success",
					value: "Delete"
				}).then((value) => {
					if(value) {form.submit();}
				});
			} else {
				alert("don't delete");
			}
		});
	// 	var form = this;
		// event.preventDefault();
		// alert("Oh hi mark");
		// swal({
		// 	title: "Are you sure?",
		// 	text: "Once deleted, you can't get this post back."
		// 	icon: "warning",
		// 	buttons: true,
		// 	dangerMode: true,
		// })
		// .then((willDelete) => {
		// 	if (willDelete) {
		// 		swal("Cool beans!");
		// 	    // form.submit();
		// 	} else {
		//     	swal("The post is safe!");
		//     	return false;
		//   	}
		// });
	});
</script>
<script>
	$("#submit_delete").prop("disabled", false);
</script>
@endsection

@stop