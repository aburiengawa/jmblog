@extends('layouts.admin')
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<h1>Edit Comment</h1>
<div class="row">
	<div class="col-sm-9">
	{!! Form::model($comment, ['route' => ['update', $comment->id], 'method' => 'PATCH', 'files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('body', 'Content:') !!}
			{!! Form::textarea('body', null, ['class'=>'form-control']) !!}
		</div>	
		<div class="form-group">
			{!! Form::submit('Update Comment', ['class'=>'btn btn-primary col-sm-6']) !!}
		</div>
	{!! Form::close() !!}
	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminCommentsController@destroy', $comment->id], 'id' => 'delete_form']) !!}
		<div class="form-group">
			<input type="submit" id="submit_delete" class="btn btn-danger col-sm-6" value="Delete Post" disabled="disabled"/>
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
{{-- sweetalert cdn --}}
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{asset('js/sweetalert.min.js')}}"></script>
@include('includes.delete-swal');
<script>
	$("#submit_delete").prop("disabled", false);
</script>
@endsection

@stop