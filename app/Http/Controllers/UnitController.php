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
            [
                'units' => $units,
                'showLinks' => true,
            ]
        );
    }

    public function search(Request $request)
    {
        $request->validate([
            'unit_search' => 'required'
        ]);

        $searchTerm = $request->input('unit_search');

        $units = Unit::where(
            'unit_name', 'like', '%' . $searchTerm . '%'
        )->get();



        if (count($units) > 0) {
            return view('admin.units.units')->with([
                'units' => $units ,
                'showLinks' => false,
            ]);
        }
        Session::flash('message', 'Nothing Found');
        return redirect()->back();

    }


//             --------CHECK IF NAME || CODE EXISTS_____________
    private function unitNameExists($unitName)
    {
        $unit = Unit::where(

            "unit_name", '=', $unitName
        )->first();
        if ($unit) {
            Session::flash('message', 'Unit Name (' . $unitName . ') already exists');
            return false;
        }
        return true;
    }

    private function unitCodeExists($unitCode)
    {
        $unit = Unit::where(

            "unit_code", '=', $unitCode
        )->first();
        if ($unit) {
            Session::flash('message', 'Unit Code (' . $unitCode . ') already exists');
            return false;
        }
        return true;
    }
//             --------CHECK IF NAME || CODE EXISTS_____________

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
//             --------CHECK IF NAME || CODE EXISTS_____________
        $unitName = $request->input('unit_name');
        $unitCOde = $request->input('unit_code');


        if (!$this->unitNameExists($unitName)) {
            return redirect()->back();
        }
        if (!$this->unitCodeExists($unitCOde)) {
            return redirect()->back();
        }
//             --------CHECK IF NAME || CODE EXISTS_____________
        $unit = new Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message', 'unit' . ' ' . $unit->unit_name . 'has been add');
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'unit_code' => 'required',
            'unit_id' => 'required',
            'unit_name' => 'required',
        ]);

//             --------CHECK IF NAME || CODE EXISTS_____________
        $unitName = $request->input('unit_name');
        $unitCOde = $request->input('unit_code');


        if (!$this->unitNameExists($unitName)) {
            return redirect()->back();
        }
        if (!$this->unitCodeExists($unitCOde)) {
            return redirect()->back();
        }

//             --------CHECK IF NAME || CODE EXISTS_____________


        $unitID = intval($request->input('unit_id'));
        $unit = Unit::find($unitID);

        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message', 'Unit ' . $unit->unit_name . ' Updated');
        return redirect()->back();

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

    public function delete(Request $request)
    {

        if (is_null($request->input('unit_id') || empty($request->input('unit_id')))) {
            Session::flash('message', 'unit is required');
            return redirect()->back();
        }

//        $validate = $request->validate([
//            'unit_id'=>'required',
//        ]);
//        if (! $validate){
//            Session::flash('message', 'unit ID Is required');
//            return redirect()->back();
//        }

        $id = $request->input('unit_id');
        Unit::destroy($id);
        Session::flash('message', 'unit has been deleted');
        return redirect()->back();
    }


}
