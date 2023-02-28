<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Member;
use App\Models\Catalog;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_books = Book::count();
        $total_members = Member::count();
        $total_transactions = Transaction::count();
        $total_publishers = Publisher::count();

        $data_donut = Book::select(DB::raw("COUNT(catalog_id) as total"))->groupBy('catalog_id')->orderBy('catalog_id')->pluck('total');
        $label_donut = Catalog::orderBy('catalog_id')->join('books', 'books.catalog_id', 'catalogs.id')->groupBy('catalogs.name')->pluck('catalogs.name');

        $label_bar = ['Transaction',];
        $data_bar = [];

        foreach ($label_bar as $key => $value) {
            $data_bar[$key]['label'] = $label_bar[$key];
            $data_bar[$key]['backgroundColor'] = 'rgba(60, 141, 138, 0.9)';
            $data_month = [];

            foreach (range(1, 12) as $month) {
                $data_month[] = Transaction::select(DB::raw("COUNT(*) as total"))->whereMonth('date_start', $month)->first()->total;
            }

            $data_bar[$key]['data'] = $data_month;
        }

        return view('admin.dashboard', compact('total_books', 'total_members', 'total_publishers', 'total_transactions', 'data_donut', 'label_donut', 'data_bar'));
    }
}
