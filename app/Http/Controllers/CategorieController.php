<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

use App\Category;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // $request->validate(["name" => "required|unique:categories"]);

        Category::create($request->all());

        session()->flash('success', 'Ctegorie Created Successfuly');

        return redirect(route('categorie.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categorie)
    {
        // $categorie = Category::find($id);
        return view('categories.create')->with('categorie', $categorie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $categorie)
    {
        // methode 1
        $categorie->name = $request->name;
        $categorie->save();

        // methode 2
        // $categorie->update([
        //     'name' => $request->name
        // ]);


        session()->flash('success', 'Ctegorie Updated Successfuly');
        return redirect(route('categorie.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categorie)
    {
        $categorie->delete();

        session()->flash('success', 'Ctegorie Delete Successfuly');
        return redirect(route('categorie.index'));
    }
}
