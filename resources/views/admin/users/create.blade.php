@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
@endsection

@section('content')

<h1>Create User</h1>
<div class="row">
	<div class="col-sm-12">
	{!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store']) !!}

		<div class="form-group" required>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class'=>'form-control'], array('required')) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password',['class'=>'form-control']) !!}
		</div>
		
		{!! Form::label('role_id', 'Role:') !!}
	    <div class="pretty p-switch p-fill form-group">
	    	{!! Form::radio('role_id', 3, array('checked="checked"')) !!}
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
			{!! Form::submit('Create User', ['class'=>'btn btn-primary col-sm-6']) !!}
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