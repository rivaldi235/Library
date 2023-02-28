<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.transaction.transaction_detail');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $transactionDetails = TransactionDetail::all();

        $datatables = datatables()->of($transactionDetails)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionDetail $transactionDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionDetail $transactionDetail)
    {
        //
    }
}
