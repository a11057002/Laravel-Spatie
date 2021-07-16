@extends('layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <span class="h2">申請新聞</span>
            {{-- <a class="btn btn-success float-right" href="{{ route('') }}"> 返回首頁 </a> --}}
        </div>
    </div>
    {{ Form::model(null, ['method' => 'POST', 'route' => ['news.create']]) }}
        @csrf
        <div class="form-group">
            <input type="file" name="images[]" class="form-control-file" multiple>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">申請</button>
          </div>
    {{ Form::close() }}
@endsection
