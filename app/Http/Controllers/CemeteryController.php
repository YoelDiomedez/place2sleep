<?php

namespace App\Http\Controllers;

use App\Cemetery;
use Illuminate\Http\Request;

class CemeteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

            return datatables()->eloquent(
                Cemetery::query()
           )
           ->addColumn('buttons', 'cemeteries.buttons.option')
           ->rawColumns(['buttons'])
           ->toJson();
        }
        
        return view('cemeteries.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cemetery = new Cemetery;

        $cemetery->appellation = $request->appellation;
        $cemetery->save();

        return $cemetery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cemetery $cemetery)
    {
        $cemetery->appellation = $request->appellation;
        $cemetery->update();

        return $cemetery;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cemetery  $cemetery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cemetery $cemetery)
    {
        $cemetery->delete();

        return $cemetery;
    }
}
