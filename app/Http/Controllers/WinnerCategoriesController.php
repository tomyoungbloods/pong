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
        dd("lalala");
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
    public function edit(WinnerCategory $winnerCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WinnerCategory $winnerCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WinnerCategory  $winnerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(WinnerCategory $winnerCategory)
    {
        //
    }
}
