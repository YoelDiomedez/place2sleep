<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('home');
    }

    /**
     * Show cemetery choices.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function choice() 
    {
        return view('choice');
    }
    /**
     * Sets an specified cemetery on session vars.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select($id)
    {   
        $cemetery = auth()->user()->cemeteries()->where('cemetery_id', $id)->firstOrFail();

        session([
            'cemetery_id'          => $cemetery->id,
            'cemetery_appellation' => $cemetery->appellation
        ]);

        return redirect()->intended('home');
    }
}
