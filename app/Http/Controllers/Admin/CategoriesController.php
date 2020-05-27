<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'asc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name_hy' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.categories.create')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $category = new Category;
            $category->translateOrNew('hy')->name = $request->name_hy;
            $category->translateOrNew('en')->name = $request->name_en;
            $category->translateOrNew('ru')->name = $request->name_ru;
            $category->parent_id = $request->category_id;
            $category->save();

            // redirect
            return redirect()->route('admin.categories')
                ->with('message', 'Successfully created');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::withoutGlobalScope('onlyParents')->findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $rules = array(
            'name_hy' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.categories.edit', [$id])
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            // store
            $category = Category::findOrFail($id);
            $category->translateOrNew('hy')->name = $request->name_hy;
            $category->translateOrNew('en')->name = $request->name_en;
            $category->translateOrNew('ru')->name = $request->name_ru;
            $category->save();

            // redirect
            return redirect()->route('admin.categories')
                ->with('message', 'Successfully Edited');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $category = Category::withoutGlobalScope('onlyParents')->findOrFail($id);
        $category->delete();

        // redirect
        return redirect()->route('admin.categories')
            ->with('message', 'Successfully Deleted');;
    }
}
