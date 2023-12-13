@extends('layouts.app')

@section('content')
    <div class="container border-style:none;" >
        <div class="row justify-content-center">
            <div class="col-md-10 animate_animated animate_zoomIn  ">
                <div class="card">
                    <div class="card-header text-dark bg-light">{{ __('Transaction Detail') }}</div>

                    <div class="card-body">
                         @if (session('status'))
                             <div class="alert alert-success" role="alert">
                                 {{ session('status') }}
                             </div>
                         @endif

                        <table class="table">
                            <tr>
                                <td class="col-md-2">Date : <b>{{ $tran->date }}<b> </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Served By : <b>{{ Auth::user()->name }}<b> </td>
                            </tr>
                        </table>

                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Item Name</td>
                                <td>qty</td>
                                <td>Price</td>
                                <td>Sub Total</td>                         
                            </thead>
                            @foreach ($transaksi as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->item->name }}</td>
                                <td>{{ $i->qty }}</td>
                                <td>{{ $i->item->price }}</td>
                                <td>{{ $i->subtotal }}</td>
                                <td>                            
                                </td>
                            </tr> 
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end">Grand Total</td>
                                <td>{{ $tran->total }}</td>
                            </tr>      
                            <tr>
                                <td colspan="4" class="text-end">Pay Total</td>
                                <td>{{ $tran->pay_total }}</td>
                            </tr>                      
                            <tr>
                                <td colspan="4" class="text-end">Change</td>
                                <td>{{ $tran->pay_total - $tran->total }}</td>
                            </tr>                                      
                        </table>
                        <a href="/transaction" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
