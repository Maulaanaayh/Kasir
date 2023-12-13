@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-light" style="background: linear-gradient(to Right, #000046, #1CB5E0);">{{ __('History') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <table class="table table-responsive table-striped">
                            <thead>
                                <td>#</td>
                                <td>Date</td>
                                <td>Total Transaction</td>
                                <td>Pay Total</td>
                                <td>Served By</td>                         
                                <td>Action</td>
                            </thead>
                            @foreach ($transaksi as $i)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $i->created_at }}</td>
                                <td>{{ $i->total}} </td>
                                <td>{{ $i->pay_total }}</td>
                                <td>{{ $i->user->name }}</td>
                                <td>
                                     <a href="{{ route('transaction.show', $i->id )}}" class="btn btn-sm btn-primary">Detail</a>

                                </td>
                            </tr>
                            @endforeach                        
                        </table>
                    `</div>
                </div>
            </div>

        </div>
    </div>
@endsection