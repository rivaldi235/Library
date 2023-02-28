@extends('layouts.admin')
@section('header', 'Create Transaction')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
@endsection

@section('content')
<div id="controller" class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create New Transaction</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url('transactions') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="member_id">Member</label>
                            <select name="member_id" id="member_id" class="form-control select2">
                                <option value="">Choose Member</option>
                                @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="date_start">Date Start</label>
                            <input type="date" name="date_start" id="date_start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="date_end">Date End</label>
                            <input type="date" name="date_end" id="date_end" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="book_id">Choose Book</label>
                            <select name="book_id[]" id="book_id" class="form-control select2-multiple" multiple="multiple">
                                @foreach ($books as $book)
                                    <option value="{{ $book->id }}">
                                        {{ $book->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                       <a href="{{ url('transactions') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $(function () {
    //Initialize Select2 Elements
        $('.select2').select2();
        $('.select2-multiple').select2();
    });
</script>
@endsection
