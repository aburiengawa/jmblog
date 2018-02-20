@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
@endsection
@section('content')
<h1>User Settings</h1>
<div class="row">
	<div class="col-sm-12">
	{!! Form::model($user, ['route' => ['update_user', $user->id], 'method' => 'PATCH', 'files'=>true]) !!}
		<div class="form-group">
			{!! Form::label('name', 'Change name:') !!}
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::hidden('email') !!}
		</div>
		<div class="form-group">
			{!! Form::hidden('role_id') !!}
		</div>
		<div class="form-group">
			{!! Form::label('password', 'Change password:') !!}
			{!! Form::password('password',['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			<label>Last updated:</label> {{ $user->updated_at->diffForHumans() }}
		</div>	
		<div class="form-group">
			{!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
		</div>
	{!! Form::close() !!}
	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy_self', $user->id]]) !!}
		<div class="form-group">
			{!! Form::submit('Delete my account', ['class'=>'btn btn-danger col-sm-6']) !!}
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