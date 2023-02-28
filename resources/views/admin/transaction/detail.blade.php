@extends('layouts.admin')
@section('header', 'Detail Transaction')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<div id="controller" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Transaction Detail</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Peminjam :</th>
                            <td>{{ $transaction->member->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjam:</th>
                            <td>{{ convertDate($transaction->date_start) }}</td>
                        </tr>
                        <tr>
                        <th>Buku:</th>
                            <td>
                                @foreach ($transaction->TransactionDetails as $transactionDetail)
                                <ul>
                                    <li>{{ $transactionDetail->book->title }}</li>
                                </ul>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>{{ $transaction->status == 1 ? 'Returned' : 'On Loan' }}</td>
                        </tr>
                    </table>
                    <div class="card-footer">
                        <a href="{{ url('transactions') }}" class="btn btn-secondary float-left">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection