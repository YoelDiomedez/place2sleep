<?php

namespace App\Http\Controllers;

use App\Mausoleum;
use Illuminate\Http\Request;

class MausoleumController extends Controller
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
                    Mausoleum::with('pavilion')->where('pavilion_id', $request->pavilion_id)
                )
                ->addColumn('buttons', 'mausoleums.buttons.option')
                ->rawColumns(['buttons'])
                ->toJson();
            }
            // Get all mausoleums and pavilions from current cemetery selected
            $pavilions = \App\Pavilion::select('id')
                                       ->where('cemetery_id', auth()->user()->cemetery_id)
                                       ->get();

            return datatables()->eloquent(
                Mausoleum::with('pavilion')->whereIn('pavilion_id', $pavilions)
            )
            ->addColumn('buttons', 'mausoleums.buttons.option')
            ->rawColumns(['buttons'])
            ->toJson();
        }

        return view('mausoleums.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mausoleum = new Mausoleum;

        $mausoleum->pavilion_id   = $request->pavilion_id;
        $mausoleum->name          = $request->name;
        $mausoleum->location      = $request->location;
        $mausoleum->reference_doc = $request->reference_doc;
        $mausoleum->size          = $request->size;
        $mausoleum->availability  = $request->size;
        $mausoleum->extensions    = 0;
        $mausoleum->price         = $request->price;

        $mausoleum->save();

        return $mausoleum;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function show(Mausoleum $mausoleum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mausoleum $mausoleum)
    {
        $mausoleum->pavilion_id   = $request->pavilion_id;
        $mausoleum->name          = $request->name;
        $mausoleum->location      = $request->location;
        $mausoleum->reference_doc = $request->reference_doc;
        $mausoleum->availability  = $mausoleum->availability + $request->extensions;
        $mausoleum->extensions    = $mausoleum->extensions + $request->extensions;
        $mausoleum->price         = $request->price;

        $mausoleum->update();

        return $mausoleum->load('pavilion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mausoleum  $mausoleum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mausoleum $mausoleum)
    {
        $mausoleum->delete();

        return $mausoleum;
    }
}
