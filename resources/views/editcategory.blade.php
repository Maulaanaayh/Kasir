@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-light bg-success">{{ __('Edit Category') }}</div>

                <div class="card-body " >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                    <form method="post" enctype="multipart/form-data" action="{{route('category.update', $category->id)}}">
                        @csrf
                        @method('put')
                        <div class="form-group">
                         <input type="text" name="name" class="form-control" value="{{ $category->name}}">
                        </div>
                        <div class="form-group mt-2">
                            <button class="btn btn-sm btn-primary">Simpan</button>
                            <a href="/category" class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </form>

                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
