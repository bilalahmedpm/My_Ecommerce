<?php

namespace App\Http\Controllers;

use App\Category;
use App\sub_category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        if ($user->role == 1)
        {
            $categories = Category::where('status', '=', 0)->count();
            $category_requests = Category::where('status', '=', 1)->count();
            $subcategories = sub_category::where('status', '=', 0)->count();
            $subcategory_requests = sub_category::where('status', '=', 1)->count();
        }
        else
        {
            $categories = Category::Where('user_id','=',$user->id)->where('status', '=', 0)->count();
            $pending_categories = Category::Where('user_id','=',$user->id)->where('status', '=', 1)->count();
            $subcategories = sub_category::Where('user_id','=',$user->id)->where('status', '=', 0)->count();
            $pending_subcategories = sub_category::Where('user_id','=',$user->id)->where('status', '=', 1)->count();
        }
        if ($user->role == 1){
            return view('admin.index', compact('categories','category_requests','subcategories','subcategory_requests'));
        }
        else{
            return view('admin.index', compact('categories','subcategories','pending_categories','pending_subcategories'));
        }

    }
}
