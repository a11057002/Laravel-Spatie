@extends('layouts.app')


@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <span class="h2">申請新聞</span>
            {{-- <a class="btn btn-success float-right" href="{{ route('') }}"> 返回首頁 </a> --}}
        </div>
    </div>
    <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        <div class="custom-file">
            <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
            <label class="custom-file-label" for="images">選擇相片</label>
        </div>

        <div class="user-image mb-3 text-center">
            <div id="preview" class="imgPreview"> </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">申請</button>
        </div>
    </form>
    {{-- {{ Form::model(null, ['method' => 'POST', 'route' => ['news.create']]) }}
        @csrf
        <div class="form-group">
            <input type="file" name="images[]" class="form-control-file" multiple>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">申請</button>
          </div>
    {{ Form::close() }} --}}
@endsection

@push('scripts')
    <script>
        window.onload = () => {
            document.getElementById("images").addEventListener("change", () => {
                input = document.getElementById("images");
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            image = document.createElement('img');
                            image.className = "w-50";
                            image.src = event.target.result;
                            document.getElementById('preview').append(image);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            })
        }
    </script>
@endpush
