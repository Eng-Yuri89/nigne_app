<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


/**
 * Class UnitController
 * @package App\Http\Controllers
 */
class  UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $units = Unit::orderBy('unit_code')->paginate(20);
        return view('admin.units.units')->with(
            ['units' => $units]
        );
    }

    public function search(Request $request){
        // TODO:     add unit search
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Todo: check if the unit alerady exists
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);

        $unit = new Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message', 'unit' . ' '.$unit->unit_name . 'has been add');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAdd()
    {
        return view('admin.units.add_edit');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        // TODO : upadte the given unit
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }

    public function delete(Request $request){

        $id=$request->input('unit_id');
        Unit::destroy($id);
        Session::flash('message', 'unit' . 'has been delete');
        return redirect()->back();


    }


}
