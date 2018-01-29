@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
@endsection

@section('content')

<h1>Edit Post</h1>

<div class="row">

	<div class="col-sm-12">

	{!! Form::model($user, ['route' => ['update_user', $user->id], 'method' => 'PATCH', 'files'=>true]) !!}

		<div class="form-group">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password',['class'=>'form-control']) !!}
		</div>	

		<div class="form-group">
			Date created: {{ $user->created_at->diffForHumans() }}
		</div>	

	    <div class="pretty p-switch p-fill form-group">
	        <input type="radio" name="switch1" />
	        <div class="state p-success">
	            <label>Reader</label>
	        </div>
	    </div>

	    <div class="pretty p-switch p-fill form-group">
	        <input type="radio" name="switch1" />
	        <div class="state p-success">
	            <label>Author</label>
	        </div>
	    </div>

	    <div class="pretty p-switch p-fill form-group">
	        <input type="radio" name="switch1" />
	        <div class="state p-success">
	            <label>Admin</label>
	        </div>
	    </div>

		<div class="form-group">
			{!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
		</div>

	{!! Form::close() !!}

	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
	
		<div class="form-group">
			{!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
		</div>

	{!! Form::close() !!}
	</div>
</div>

{{-- <div class="row">
	@include('includes.form-error')
</div> --}}

@section('scripts')

@endsection

@stop