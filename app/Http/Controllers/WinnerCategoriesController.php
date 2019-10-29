<?php

namespace App\Http\Controllers;

use App\WinnerCategory;
use Illuminate\Http\Request;

class WinnerCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // Take al categories
         $categories = WinnerCategory::all();
         // categories in Array
         $array = [ 
             'categories' => $categories,
         ]; 
         // Return view with Array
         return view('categories.categories')->with($array);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create-categories');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Make new model called WinnerCategory
        $category = new WinnerCategory();
        $category->name = request('name');
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(WinnerCategory $winnerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find category by id
        $category = WinnerCategory::find($id);
        //Return view and send $category 
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find category by ID
        $category = WinnerCategory::find($id);
        // Edit category Name to the request name
        $category->name = request('name');
        // Save category
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find category by ID
        $category = WinnerCategory::where('id', $id)->firstOrFail();
        // Delete category
        $category->Delete();
        // Redirect to home
        return redirect('/'); 
    }
}
