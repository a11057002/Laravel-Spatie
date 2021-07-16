@extends('layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <span class="h2">用戶管理</span>
            <a class="btn btn-success float-right" href="{{ route('users.create') }}"> 建立新用戶 </a>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="flash-message alert alert-success ">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            {{ $message }}
        </div>
    @endif


    <table class="table table-bordered ">
        <tr>
            <th>編號</th>
            <th>名字</th>
            <th>信箱</th>
            <th>身份</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-secondary">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('users.show', $user->id) }}">資料</a>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">編輯</a>
                    
                    @if (auth()->user()->id != $user->id)                        
                    <form class="d-inline" action="/users/{{ $user->id }}" method="post">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <input class="btn btn-danger" type="submit" value="刪除">
                    </form>
                    @endif
                    {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!} --}}
                </td>
            </tr>
        @endforeach
    </table>


    {!! $data->render() !!}

@endsection
