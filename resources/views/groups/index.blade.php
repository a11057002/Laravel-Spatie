@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <span class="h2"> 群組管理 </span>
            @can('group-create')
                <a class="btn btn-success float-right" href="{{ route('groups.create') }}"> 新建群組 </a>
            @endcan
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif


    <table id="groupTable" class="table table-bordered mt-3 ">
        <tr>
            <th>編號</th>
            <th>群組名稱</th>
            <th>成員</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($groups as $key => $group)
            <tr>
                <td>{{ $group->id }}</td>
                <td id="{{ $group->name }}">{{ $group->name }}</td>
                <td style="max-width:200px;">
                    @if (!empty($group->getUsersName()))
                        @foreach ($group->getUsersName() as $name)
                            <label class="badge badge-light">{{ $name }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    {{-- <a class="btn btn-primary" href="{{ route('groups.show', $group->id) }}">Show</a> --}}
                    @can('group-edit')
                        <a class="btn btn-primary" href="{{ route('groups.edit', $group->id) }}">編輯</a>
                        {{-- <a class="btn btn-primary" id="{{$group->id}}" data-group="{{$group->name}}" data-id="{{$group->id}}"  data-toggle="modal" data-target="#editModal">編輯</a> --}}
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
    {{ $groups->links() }}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">編輯</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered dataTable no-footer">
                        <thead>
                            <th>群組名稱</th>
                            <th>動作</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="editGroupName"></td>
                                <td><button id="editGroupbtn" class="btn btn-primary" data-dismiss="modal">送出</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">關閉</button>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">訊息</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">關閉</button>

                </div>
            </div>
        </div>
    </div>
@endsection
