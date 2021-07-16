@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 ">
            <span class="h2">編輯用戶</span>
            <a class="btn btn-primary float-right" href="{{ route('users.index') }}"> 返回 </a>
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


    {{ Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) }}
    <div class="row mt-3">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>名字:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>信箱:</strong>
                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>密碼:</strong>
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>確認密碼:</strong>
                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>身份:</strong>
                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}

                <!-- CheckBox form of Roles selection -->
                <!-- @foreach ($roles as $role) <li style="list-style-type: none;" label={{ $role }}>
                    {!! Form::checkbox('roles[]', $role, $userRole[$role] ?? null) !!}
                    {{ $role }}
                </li> @endforeach  -->

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>群組:</strong>
                {!! Form::select('groups[]', $groups, $userGroup, ['class' => 'form-control', 'multiple']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection
