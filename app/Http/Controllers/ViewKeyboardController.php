<?php

namespace App\Http\Controllers;

use App\Models\Keyboard;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewKeyboardController extends Controller
{
    public function get_view_keyboard_page($categoryID){
        $keyboards = Keyboard::where('category_id', $categoryID)
                    ->paginate(8);
        $header_categories = Category::all();
        $user = Auth::user();
        return view('keyboard.view_keyboard',
                compact('keyboards', 'user', 'categoryID', 'header_categories'));
    }
    public function process_filter_keyboard(Request $request, $categoryID){
        if ($request->filter == "Name"){
            $keyboards = Keyboard::where('category_id', $categoryID)
                        ->where("name", $request->search)
                        ->orWhere("name", 'LIKE', "%".$request->search."%")
                        ->get();
        }
        else if ($request->filter == "Price"){
            $keyboards = Keyboard::where('category_id', $categoryID)
                        ->where('price', $request->search)
                        ->get();
        }

        $user = Auth::user();
        return view('keyboard.view_keyboard', compact('keyboards', 'user', 'categoryID'));
    }
}
