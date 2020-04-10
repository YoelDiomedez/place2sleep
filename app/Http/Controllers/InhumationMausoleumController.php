<?php

namespace App\Http\Controllers;

use App\Mausoleum;
use App\Inhumation;
use Illuminate\Http\Request;

class InhumationMausoleumController extends Controller
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
            // Filter all mausoleums of a specific pavilion
            if ( $request->pavilion_id ) {
                return datatables()->eloquent(

                    Mausoleum::with(['pavilion', 'buries', 'buries.deceased', 'buries.relative'])
                        ->whereHas('buries')->whereHas('pavilion', function ($query) {
                            $query->where('cemetery_id', auth()->user()->cemetery_id); 
                        })->where('pavilion_id', $request->pavilion_id)

                )
                ->addColumn('buttons', 'inhumations.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Default List
            return datatables()->eloquent(

                Mausoleum::with(['pavilion', 'buries', 'buries.deceased', 'buries.relative'])
                        ->whereHas('buries')->whereHas('pavilion', function ($query) {
                            $query->where('cemetery_id', auth()->user()->cemetery_id); 
                        })
                        
            )
            ->addColumn('buttons', 'inhumations.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('inhumations.mausoleum.index');
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

        $mausoleum = Mausoleum::findOrFail($request->mausoleum_id);
        $mausoleum->availability = $mausoleum->availability - 1;
        $mausoleum->update();

        $inhumation->amount = $mausoleum->price / $mausoleum->size;

        $inhumation->buriable()->associate($mausoleum)->save();

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

        if ($inhumation->buriable_id != $request->mausoleum_id) {

            $old_mausoleum = Mausoleum::findOrFail($inhumation->buriable_id);
            $old_mausoleum->availability = $old_mausoleum->availability + 1;
            $old_mausoleum->update();
            
            $new_mausoleum = Mausoleum::findOrFail($request->mausoleum_id);
            $new_mausoleum->availability = $new_mausoleum->availability - 1;
            $new_mausoleum->update();

            $inhumation->amount = $new_mausoleum->price / $new_mausoleum->size;

            $inhumation->buriable()->associate($new_mausoleum)->update();
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
        $mausoleum = Mausoleum::findOrFail($inhumation->buriable_id);
        $mausoleum->availability = $mausoleum->availability + 1;
        $mausoleum->update();
        
        $inhumation->delete();

        return $inhumation;
    }
}
