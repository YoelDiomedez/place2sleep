<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
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
                 Period::query()
            )
            ->addColumn('btnEdit', "<button id='btnEditPeriod' class='btn yellow btn-outline'><i class='fa fa-edit'></i></button>")
            ->addColumn('btnDelete', "<button id='btnDeletePeriod' class='btn red btn-outline'><i class='fa fa-trash'></i></button>")
            ->rawColumns(['btnEdit', 'btnDelete'])
            ->toJson();
        }
        
        return view('periods.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $period = new Period;

        $period->year = $request->year;
        $period->appellation = $request->appellation;

        $period->save();

        return $period;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Period $period)
    {
        $period->year = $request->year;
        $period->appellation = $request->appellation;

        $period->update();

        return $period;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        $period->delete();

        return $period;
    }
}
