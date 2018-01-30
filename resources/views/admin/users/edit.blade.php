@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
@endsection

@section('content')

<h1>Edit User</h1>

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
			{!! Form::label('password', 'Change password:') !!}
			{!! Form::password('password',['class'=>'form-control']) !!}
		</div>
		
		{!! Form::label('role_id', 'Role:') !!}
	    <div class="pretty p-switch p-fill form-group">
	    	{!! Form::radio('role_id', 3) !!}
	        <div class="state p-success">
	            <label>Reader</label>
	        </div>
	    </div>

	    <div class="pretty p-switch p-fill form-group">
	        {!! Form::radio('role_id', 2) !!}
	        <div class="state p-primary">
	            <label>Author</label>
	        </div>
	    </div>

	    <div class="pretty p-switch p-fill form-group">
	        {!! Form::radio('role_id', 1) !!}
	        <div class="state p-danger">
	            <label>Admin</label>
	        </div>
	    </div>

		<div class="form-group">
			<label>Date created:</label> {{ $user->created_at->diffForHumans() }}
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

	</div> {{--.col-sm-12--}}
</div> {{--.row--}}

{{-- <div class="row">
	@include('includes.form-error')
</div> --}}

@section('scripts')

@endsection

@stop