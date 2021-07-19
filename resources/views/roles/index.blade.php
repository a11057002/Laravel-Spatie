@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <span class="h2">身份管理</span>
            @can('role-create')
                <a class="btn btn-success float-right" href="{{ route('roles.create') }}"> 新建身份 </a>
            @endcan
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif


    <table class="table table-bordered mt-3 ">
        <tr>
            <th>編號</th>
            <th>名稱</th>
            <th>功能</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td style="max-width:200px;">
                    @if (!empty($role->getAllPermissions()))
                        @foreach ($role->getAllPermissions() as $v)
                            <label class="badge badge-secondary">{{ $v['name'] }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    {{-- <a class="btn btn-primary" href="{{ route('roles.show', $role->id) }}">Show</a> --}}
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">編輯</a>
                    @endcan
                    @can('role-delete')
                        <form class="d-inline" action="/roles/{{ $role->id }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="btn btn-danger" type="submit" value="刪除">
                        </form>
                        {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!} --}}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $roles->render() !!}


@endsection
