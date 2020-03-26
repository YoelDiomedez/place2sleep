<?php

namespace App\Http\Controllers;

use App\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $period = \App\Period::where('year', date('Y'))->first();
        $year   = ($period != null) ? true : false;

        if ($request->ajax()) {

            if ($year) {
                return datatables()->eloquent(
                    Price::where('period_id', $period->id)
                        ->where('cemetery_id', auth()->user()->cemetery_id)
                )
                ->addColumn('buttons', 'prices.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }

            return datatables()->eloquent(
                Price::query()
            )
            ->addColumn('buttons', 'prices.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
            
        }
        
        return view('prices.index', ['period' => $period, 'year' => $year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $price = new Price;

        $price->period_id   = $request->period_id;
        $price->cemetery_id = auth()->user()->cemetery_id;
        $price->concept     = $request->concept;
        $price->amount      = $request->amount;

        $price->save();

        return $price;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        $price->concept     = $request->concept;
        $price->amount      = $request->amount;

        $price->update();

        return $price;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $price->delete();

        return $price;
    }
}
