<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(10);
        return view('admin.categories.categories')->with([
            'categories'=>$categories,
            'showLinks' => true,
        ]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'category_search' => 'required'
        ]);

        $searchTerm = $request->input('category_search');

        $categories = Category::where(
            'name', 'like', '%' . $searchTerm . '%'
        )->get();



        if (count($categories) > 0) {
            return view('admin.categories.categories')->with([
                'categories' => $categories ,
                'showLinks' => false,
            ]);
        }
        Session::flash('message', 'Nothing Found');
        return redirect()->back();

    }


//             --------CHECK IF NAME || CODE EXISTS_____________
    private function categoryNameExists($category)
    {
        $category = Category::where(

            "name", '=', $category
        )->first();
        if ($category) {
            Session::flash('message', 'category Name (' . $category->category . ') already exists');
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
        $request->validate([
            'name' => 'required',
        ]);
//             --------CHECK IF NAME || CODE EXISTS_____________
        $categoryName = $request->input('name');


        if (!$this->categoryNameExists($categoryName)) {
            return redirect()->back();
        }

//             --------CHECK IF NAME || CODE EXISTS_____________
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
        Session::flash('message', 'category' . ' ' . $category->name . 'has been add');
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
            'category_name' => 'required',

        ]);

//             --------CHECK IF NAME || CODE EXISTS_____________
        $category = $request->input('category_name');
        if (!$this->categoryNameExists($category)) {
            return redirect()->back();
        }

//             --------CHECK IF NAME || CODE EXISTS_____________

        $categoryID = intval($request->input('category_id'));
        $category = Category::find($categoryID);

        $category->name = $request->input('category_name');
        $category->save();
        Session::flash('message', 'Tag ' . $category->name . ' Updated');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function delete(Request $request)
    {

        if (is_null($request->input('name') || empty($request->input('name')))) {
            Session::flash('message', 'category is required');
            return redirect()->back();
        }

        $categoryName = $request->input('category_name');
        $id = $request->input('category_id');
        Category::destroy($id);
        Session::flash('message', 'Category   (' .$categoryName.') has been deleted');
        return redirect()->back();
    }


}
