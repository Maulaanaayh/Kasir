@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">{{ __('Add Item') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)

                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('item.update', $item->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="category">Item Category</label>
                                <select name="category_id" class="form-control form-select" id="">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Item Name</label>
                                <input type="text" class="form-control" value="{{$item->name}}" placeholder="nama" name="name">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" value="{{$item->price}}" placeholder="price" name="price" min="1">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control"value="{{$item->stock}}" placeholder="stock" name="stock" min="1">
                            </div>
                            

                            <div class="form-group mt-2">
                                
                                <input type="submit" class="btn btn-sm btn-success" value="Simpan">
                                <input type="reset" value="Batal" class="btn btn-sm btn-danger">
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection