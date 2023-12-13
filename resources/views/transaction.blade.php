@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Item Transaction') }}</div>

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
                                <td>Quantity</td>
                                <td>Action</td>
                            </thead>
                            @foreach ($item as $i)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                    <td> {{ $i->category->name }}</td>
                                    <td> {{ $i->name }}</td>
                                    <td> Rp. {{ number_format($i->price) }}</td>
                                    <td > {{ $i->stock }}</td>
                                <td>
                                    <form action="{{ route('transaction.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $i->id }}" name="item_id">
                                        <input class="form-control" type="hidden" name="qty" value=1>
                                        <button class="btn btn-sm btn-primary">Add to cart</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        {{-- {{ __('You are logged in!') }} --}}
                    </div>
                </div>
            </div>


            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('Cart') }}</div>

                    <div class="card-body">
                        @if (session('check'))
                            <div class="alert alert-success" role="alert">
                                {{ session('check') }}
                            </div>
                        @endif

                            <table class="table table-striped">
                                <thead>
                                    <td>#</td>
                                    <td>Name</td>
                                    <td class="col-md-3">qty</td>
                                    <td>Subtotal</td>
                                    <td>Action</td>
                                </thead>
                                @if ($carts->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center">Keranjang kosong</td>
                                    </tr>
                                @else
                                    
                                
                                @foreach ($carts as $cart)
                                <tr>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $cart->name }}</td>
                                    <td>
                                        <form action="{{ route('transaction.update', $cart->cart->id) }}" method="post">
                                        @method('PUT')
                                        @csrf 
                                        <input class="form-control" min="1" max="{{ $cart->stock +  $cart->cart->qty }}" onchange="update{{ $loop->iteration}}()" type="number" name="qty" value="{{ $cart->cart->qty }}">                                        
                                    </td>
                                    <td>{{ $cart->price * $cart->cart->qty }}</td>
                                    <td>
                                        <input class="btn btn-cm btn-primary" type="submit" id="ubah{{ $loop->iteration }}" style="display:none" value="Update">
                                        </form>
                                        <form action="{{ route('transaction.destroy', $cart->cart->id) }}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <input class="btn btn-sm btn-danger" type="submit" id="hapus{{ $loop->iteration }}"  value="Hapus">
                                        </form>
                                        <script>
                                            function update{{ $loop->iteration }}(){
                                                document.getElementById("ubah{{ $loop->iteration }}").style.display = "inline";
                                                document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";
                                            }
                                        </script>
                                    </td>                                    
                                </tr>                                 
                                @endforeach
                                @endif
                                <form action="{{ route('transaction.checkout') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <tr>
                                        <td colspan="2">Total</td>
                                        <td colspan="2"><input class="form-control" value="{{ $carts->sum(function($i){ return $i->price * $i->cart->qty;}) }}" readonly type="number" name="total" id=""></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Payment</td>
                                        <td colspan="2"><input class="form-control" type="number" min="{{ $carts->sum(function($i){ return $i->price * $i->cart->qty;}) }}" required name="pay_total" id=""></td>
                                    </tr>
                                </table>
                                <button type="submit" class="btn btn-primary text-light">Checkout</button>
                                <input type="reset" class="btn btn-danger text-light" value="Cancel">
                            </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection