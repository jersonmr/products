@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update your profile</div>

                <div class="panel-body">

                    @if (Session::has('message'))
                        <div class="alert alert-success text-center">
                            <i class="fa fa-info-circle fa-2x"></i> <strong>{{ strtoupper(Session::get('message')) }}</strong>
                        </div>
                    @endif

                    {!! Form::model($user, ['route' => ['update-profile', $user->id]]) !!}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-xs-12 col-md-6 col-md-offset-3">
                            {!! Form::label("name", "Name") !!}
                            {!! Form::text("name", null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-xs-12 col-md-6 col-md-offset-3">   
                            {!! Form::label("email", "Email") !!}
                            {!! Form::email("email", null, ['class' => 'form-control']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="form-group col-xs-12 col-md-6 col-md-offset-3">   
                            {!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection