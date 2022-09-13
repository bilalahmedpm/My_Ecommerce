<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 1) {
            $category = Category::where('status', '=', 0)->get();
        } else {
            $category = Category::where('user_id', '=', $user->id)->get();
        }
        return view('admin.category.index', compact('category'));

    }

    public function cat_request()
    {
        $user = Auth::user();
        if ($user->role == 1) {
            $category = Category::where('status', '=', 1)->get();
        }
        return view('admin.category.index', compact('category'));
    }

    public function cat_approve($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->update();
        return redirect()->back()->with('message', 'Record Status Updated Successfully !');
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = $user->id;
        if ($user->role == 1) {
            $category->status = 0;
        } else {
            $category->status = 1;
        }
        if ($request->hasfile('image')) {

            $image1 = $request->file('image');
            $name = time() . 'image' . '.' . $image1->getClientOriginalExtension();
            $destinationPath = 'image/';
            $image1->move($destinationPath, $name);
            $category->img = 'image/' . $name;
        }
        $category->save();
        return redirect()->back()->with('message', 'Record Added Successfully !');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('error', 'Record Deleted Successfully !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        if ($request->hasfile('image')) {

            $image1 = $request->file('image');
            $name = time() . 'image' . '.' . $image1->getClientOriginalExtension();
            $destinationPath = 'image/';
            $image1->move($destinationPath, $name);
            $category->img = 'image/' . $name;
        }
        $category->update();
        return redirect()->back()->with('message', 'Record Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {

    }
}
