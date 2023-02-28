<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AuthorController extends Controller
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
        return view('admin.author');
    }

    public function api()
    {
        $authors = Author::all();

        // foreach($authors as $key=>$author){
        //     $author->date = convertDate($author->created_at);
        // }
        
        $datatables = datatables()->of($authors)
            ->addColumn('date', function($author){
                return convertDate($author->created_at);
            })->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        Author::create($request->all());
        return redirect('authors')->with('success', 'Berhasil menambahkan data Author');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate(
            [
                'name'=>'required|max:64',
                'email'=>'required|email|max:64',
                'phone_number'=>'required|max:12',
                'address'=>'required|max:225',
            ]
        );

        $author->update($request->all());
        return redirect('authors')->with('success', 'Berhasil menambahkan data Author');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
    }
}
