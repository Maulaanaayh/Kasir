@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Master Category') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>Action</td>
                                </thead>
                                @foreach ($categories as $category)
                                <tr>
                                    <td> {{ $loop->iteration}}</td>
                                    <td> {{ $category->name }}</td>
                                    <td>
                                        <a href="/category/{{$category->id}}/edit" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{route ('category.destroy', $category->id)}}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </table>
                        </div>
                    </div>
                </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Add Category') }} </div>
                
                                <div class="card-body">
                                    
                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>    
                                             @endif
                                        <form method="post" enctype="multipart/form-data" action="{{route('category.store')}}">
                                        @csrf
                                        <div class="form-group">
                                         <input  class="form-control" name="name" type="text" placeholder="Nama Kategori">
                                        </div>
                                        <div class="form-group mt-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
