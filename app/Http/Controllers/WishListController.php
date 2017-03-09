<?php

namespace App\Http\Controllers;

use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function getWishList()
    {
        $wish_list = WishList::all();                

        return view('wlist', compact('wish_list'));
    }

    public function deleteItem($item_id)
    {
        $item = WishList::findOrFail($item_id);

        $item->delete();

        Session::flash('message', 'The article was deleted successfully!');

        return redirect()->back();
    }
}
