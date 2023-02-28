<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.publisher');
    }

    public function api()
    {
        $publishers = Publisher::all();
        $datatables = datatables()->of($publishers)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publisher');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name'=>'required|max:64',
                'email'=>'required|email|max:64',
                'phone_number'=>'required|max:12',
                'address'=>'required|max:225',
            ]
        );

        Publisher::create($request->all());
        return redirect('publishers');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers', compact('publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $request->validate(
            [
                'name'=>'required|max:64',
                'email'=>'required|email|max:64',
                'phone_number'=>'required|max:12',
                'address'=>'required|max:225',
            ]
        );

        $publisher->update($request->all());
              return redirect('publishers');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
    }
}
