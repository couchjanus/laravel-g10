@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Hello {{ Auth::user()->name }} !</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive col-12">
            @if (Session::get('errors') != Null)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{  $errors->first() }}
                    </div>
            @endif
            
            
            {!! Form::open(['method'=>'PUT', 'route' => array('profile.update', $profile)]) !!}

                <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                    {!! Form::label('first_name', 'First Name', array('class' => 'col-3 control-label')); !!}
                    {!! Form::text('first_name', $profile->first_name, array('id' => 'first_name', 'class' => 'form-control col-9', 'placeholder' => 'First Name')) !!}
                    @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                    {!! Form::label('last_name', 'Last Name', array('class' => 'col-3 control-label')); !!}
                    {!! Form::text('last_name', $profile->last_name, array('id' => 'last_name', 'class' => 'form-control col-9', 'placeholder' => 'Last Name')) !!}
                    @if ($errors->has('last_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback row {{ $errors->has('location') ? ' has-error ' : '' }}">
                        {!! Form::label('location', 'Location', array('class' => 'col-3 control-label')); !!}
                        {!! Form::text('location', $profile->location, array('id' => 'location', 'class' => 'form-control col-9', 'placeholder' => 'Location')) !!}
                        @if ($errors->has('location'))
                        <span class="help-block">
                          <strong>{{ $errors->first('location') }}</strong>
                        </span>
                        @endif
                </div>

                <div class="form-group has-feedback row {{ $errors->has('bio') ? ' has-error ' : '' }}">
                        {!! Form::label('bio', 'bio', array('class' => 'col-3 control-label')); !!}
                        {!! Form::text('bio', $profile->bio, array('id' => 'bio', 'class' => 'form-control col-9', 'placeholder' => 'bio')) !!}
                        @if ($errors->has('bio'))
                        <span class="help-block">
                          <strong>{{ $errors->first('bio') }}</strong>
                        </span>
                        @endif
                </div>
              
              <div class="form-group row">
                {!! Form::button('<span data-feather="save"></span>&nbsp;' . 'Update Profile', array('class' => 'btn btn-success btn-flat margin-bottom-1 pull-right','type' => 'submit', )) !!}
              </div>
                  
            {!! Form::close() !!}
        
    </div>
</div>
@endsection
