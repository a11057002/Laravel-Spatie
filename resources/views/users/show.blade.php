@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12">
            <span class="h2">用戶資料 </span>
            <a class="btn btn-primary float-right" href="{{ route('users.index') }}"> 返回 </a>
    </div>
</div>


<div class="row mt-3">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $role)
                    <label class="badge badge-secondary">{{ $role }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection