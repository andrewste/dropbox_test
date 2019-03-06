@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <form method="post" enctype="multipart/form-data"
                      action="{{ route('files.update', ['file' => $file->id]) }}">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            @csrf
                            <input type="submit" value="Save" class="btn btn-outline-secondary"/>
                        </div>
                        <div class="custom-control">
                            @csrf
                            <input name="_method" type="hidden" value="PUT">
                            <input type="file" name="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div>
                        @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                         </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection