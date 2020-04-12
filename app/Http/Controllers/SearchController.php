<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('search.index');
    }

    public function niche(Request $request)
    {
        if ( $request->ajax() ) {

            return datatables()->eloquent(

                \App\Inhumation::with(['buriable.pavilion.cemetery', 'deceased'])
                      ->whereHasMorph('buriable', \App\Niche::class)

            )->toJson();
        }

        return view('search.niche');
    }

    public function mausoleum(Request $request)
    {
        if ( $request->ajax() ) {
            
            return datatables()->eloquent(

                \App\Inhumation::with(['buriable.pavilion.cemetery', 'deceased'])
                      ->whereHasMorph('buriable', \App\Mausoleum::class)

            )->toJson();
        }

        return view('search.mausoleum');
    }
}
