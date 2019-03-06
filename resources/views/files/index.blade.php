@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($files as $file)
                <div class="col-lg-3">
                    <div class="justify-content-center">
                        <a href="{{ route('files.show', ['file' => $file->id]) }}">
                            <img src="{{route('files.show', ['file' => $file->id])}}" class="img-thumbnail" width="250"
                                 alt="img">
                        </a>
                        <div class="index-file d-flex justify-content-between my-2">
                            <div>
                                <form method="get" action="{{route('files.edit', ['file' => $file->id])}}">
                                    @csrf
                                    <input type="submit" value="Edit" class="btn btn-primary"/>
                                </form>
                            </div>
                            <div class="caption d-flex flex-column">
                                <a href="{{ route('files.show', ['file' => $file->id]) }}"
                                   class="align-self-center text-primary font-weight-bold">{{ $file->name }}</a>
                                <span class="text-center text-primary">({{ round($file->size / 1000) }} Kb)</span>
                            </div>
                            <div>
                                <form method="post" action="{{ route('files.destroy', ['file' => $file->id] )}}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-danger"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-2 my-4">
                {{$files->links()}}
            </div>
        </div>
    </div>
@endsection


