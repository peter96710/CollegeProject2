<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\User;
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
    public function main()
    {
        $users = User::count();
        $items = Item::count();
        $categories = Category::count();
        return view('main', compact('users', 'items', 'categories'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function orders()
    {
        $ordering = Order::where('user_id', Auth::id())->where('status','!=','CART')->get();

        $callback = function($query) {
            $query->where('user_id', Auth::id())->where('status','!=','CART');
        };

        $orders = OrderedItem::with('item')->with('order')
            ->whereHas('order', $callback )->get();


        return view('orders',compact('orders','ordering'));
    }
}
