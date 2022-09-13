<?php

namespace App\Http\Controllers;

use App\Category;
use App\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 1){
            $category = Category::where('status', '=', 0)->get();
            $subcategory = sub_category::where('status' , '=' , 0)->get();
        }
        else
        {
            $category = Category::where ('status' , '=' , 0)->get();
            $subcategory = sub_category::where('user_id','=', $user->id )->get();
        }

        return view('admin.subcategory.index', compact('subcategory','category'));
    }
    public function subcat_request()
    {
        $user = Auth::user();
        if ($user->role == 1)
        {
            $category = Category::where('status','=',0)->get();
            $subcategory = sub_category::where('status', '=', 1 )->get();
        }
        else
        {
            $category = Category::where('status', '=', 0)->get();
            $subcategory = sub_category::where('user_id','=', $user->id )->get();
        }
        return view('admin.subcategory.index', compact('category','subcategory'));
    }
    public function subcat_approve($id)
    {
        $category = sub_category::find($id);
        $category->status = 0;
        $category->save();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $subcategory = new sub_category();
        $subcategory->name  = $request->subcategoryname;
        $subcategory->category_id  = $request->category_id;
        if ($user->role == 1)
        {
            $subcategory->status = 0;
        }
        else
        {
            $subcategory->status = 1;
        }
        $subcategory->user_id = $user->id;
        $subcategory->save();
        return redirect()->back()->with('message', 'Record Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show(sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subcategory = sub_category::find($id);
        $subcategory->DELETE();
        return redirect()->back()->with('error', 'Record Delete Successfully !');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = sub_category::find($id);
        $subcategory->name  = $request->subcategoryname;
        $subcategory->category_id  = $request->category_id;
        $subcategory->save();
        return redirect()->back()->with('message', 'Record Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
