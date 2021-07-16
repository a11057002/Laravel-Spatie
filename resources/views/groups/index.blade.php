@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <span class="h2">身份管理</span>
            @can('group-create')
                <a class="btn btn-success float-right" href="{{ route('groups.create') }}"> 新建身份 </a>
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
            <th>群組名稱</th>
            <th>成員</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($groups as $key => $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td>{{ $group->name }}</td>
                <td style="max-width:200px;">
                    @if (!empty($group->getUsersName()))
                        @foreach ($group->getUsersName() as $v)
                            <label class="badge badge-light">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    {{-- <a class="btn btn-primary" href="{{ route('groups.show', $group->id) }}">Show</a> --}}
                    @can('group-edit')
                        <a class="btn btn-primary" href="{{ route('groups.edit', $group->id) }}">編輯</a>
                    @endcan
                    @can('group-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['groups.destroy', $group->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $groups->render() !!}


@endsection
