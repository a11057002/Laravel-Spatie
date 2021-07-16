@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <span class="h2">編輯群組</span>
            <a class="btn btn-primary float-right" href="{{ route('roles.index') }}"> 返回 </a>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{ Form::model($group, ['method' => 'PATCH', 'route' => ['groups.update', $group->id]]) }}
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>名稱:</strong>
                {{ Form::text('name', null, ['class' => 'form-control mt-2']) }}
            </div>
        </div>
        {{-- <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <p><strong>成員:</strong></p>
                @foreach ($users as $user)
                    <label>{{ Form::checkbox('groups[]', $user->id, in_array($user->id,$users->toArray()) ? true : false, ['class' => 'name']) }}
                        {{ $user->name }}
                    </label>
                    <br>
                @endforeach
            </div>
        </div> --}}
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}


@endsection
