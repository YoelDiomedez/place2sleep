<?php

namespace App\Http\Controllers;

use App\Niche;
use App\Inhumation;
use Illuminate\Http\Request;

class InhumationNicheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ( $request->ajax() ) {
            // Filter all niches of a specific pavilion
            if ( $request->pavilion_id ) {
                return datatables()->eloquent(

                    Niche::with(['pavilion', 'bury', 'bury.deceased', 'bury.relative'])
                        ->whereHas('pavilion', function ($query) {
    
                            $query->where('cemetery_id', auth()->user()->cemetery_id);
    
                        })->where('pavilion_id', $request->pavilion_id)
                          ->where('state', 'O')
                )
                ->addColumn('buttons', 'inhumations.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Default List
            return datatables()->eloquent(

                Niche::with(['pavilion', 'bury', 'bury.deceased', 'bury.relative'])
                    ->whereHas('pavilion', function ($query) {

                        $query->where('cemetery_id', auth()->user()->cemetery_id);

                    })->where('state', 'O')
            )
            ->addColumn('buttons', 'inhumations.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('inhumations.niche.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inhumation = new Inhumation;

        $inhumation->deceased_id = $request->deceased_id;
        $inhumation->relative_id = $request->relative_id;
        $inhumation->ric         = $request->ric;
        $inhumation->agreement   = $request->agreement;
        $inhumation->notes       = $request->notes;
        $inhumation->discount    = $request->discount;
        $inhumation->additional  = $request->additional;

        $niche = Niche::findOrFail($request->niche_id);
        $niche->state = 'O';
        $niche->update();

        $inhumation->amount = $niche->price;

        $inhumation->buriable()->associate($niche)->save();

        return $inhumation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inhumation  $inhumation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inhumation $inhumation)
    {
        $inhumation->deceased_id = $request->deceased_id;
        $inhumation->relative_id = $request->relative_id;
        $inhumation->ric         = $request->ric;
        $inhumation->agreement   = $request->agreement;
        $inhumation->notes       = $request->notes;
        $inhumation->discount    = $request->discount;
        $inhumation->additional  = $request->additional;

        if ($inhumation->buriable_id != $request->niche_id) {

            $old_niche = Niche::findOrFail($inhumation->buriable_id);
            $old_niche->state = 'D';
            $old_niche->update();
            
            $new_niche = Niche::findOrFail($request->niche_id);
            $new_niche->state = 'O';
            $new_niche->update();

            $inhumation->amount = $new_niche->price;

            $inhumation->buriable()->associate($new_niche)->update();
        }

        $inhumation->update();

        return $inhumation;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inhumation  $inhumation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inhumation $inhumation)
    {
        $niche = Niche::findOrFail($inhumation->buriable_id);
        $niche->state = 'D';
        $niche->update();
        
        $inhumation->delete();

        return $inhumation;
    }
}
