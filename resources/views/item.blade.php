@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Master Item') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Category</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Stock</td>
                                <td>Action</td>
                            </thead>
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->name }}</td>
                                <td>Rp. {{ number_format ($item->price) }}</td>
                                <td>{{ $item->stock }}</td>
                                {{-- <td>Makanan</td> --}}  
                                <td>
                                <a href="{{ route('item.edit' , $item -> id ) }}" class="btn btn-sm btn-warning">Edit</a>
                                {{-- <a href="{{ route('item.destroy' , $item -> id ) }}" class="btn btn-sm btn-danger">Delete</a> --}}
                                <form method="POST" class="d-inline" action="{{ route('item.destroy' , $item -> id ) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Delete</button> 
                                </form>
                                </td>
                            </tr>
                            @endforeach                            
                        </table>                        
                    </div>
                </div>
            </div>


            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Add Item') }}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)

                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <form action="{{ route('item.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Item Category</label>
                                <select name="category_id" class="form-control form-select" id="" required>
                                    <option selected disabled>--- Pilih Kategori ---</option>                                    
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="">Item Name</label>
                                <input type="text" class="form-control" placeholder="Nama" name="name">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="number" class="form-control" placeholder="Harga" name="price" min="1">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input type="number" class="form-control" placeholder="Stok" name="stock" min="1">
                            </div>
                            

                            <div class="form-group mt-2">
                                
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                <input type="reset" value="Batal" class="btn btn-sm btn-danger">                                
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection