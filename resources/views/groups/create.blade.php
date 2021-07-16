@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <span class="h2">新增群組</span>
            <a class="btn btn-primary float-right" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger mt-3">
            <strong>錯誤!</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['route' => 'groups.store', 'method' => 'POST']) !!}
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
