@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Dashboard
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                Jumlah Kategori
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $category }}</h5>
                                <p class="card-text">
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                Jumlah Produk
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item }}</h5>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                Total Transaksi
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $transdetail }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
