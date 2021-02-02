<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function new()
    {
        return view('admin/new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create($request->all());
        $items = Item::all();
        $categories = Category::all();
        return view('menu', compact('items','categories'));
    }

    public function cat()
    {
        $categories = Category::all();
        return view('admin/cat', compact('categories'));
    }

    public function delete(Request $request)
    {
        Category::where('id', $request->id)->delete();
        $categories = Category::all();
        return view('admin/cat', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::where('id', $id)->get()->first();
        return view('admin/edit', compact('categories'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string'],
            'id' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect('admin/category/cat')
                ->withErrors($validator)
                ->withInput();
        }
        Category::where('id', $request->id)
            ->update([  'name' => $request->name]);
        $categories = Category::all();
        return view('admin/cat', compact('categories'));
    }

    public function manage(){
        $orders = Order::with('user')->where('status','RECEIVED')->get();
        return view('admin/manage',compact('orders'));
    }

    public function accept($id)
    {
        Order::where('id', $id)->get()->first()->
        update([
            'status' => 'ACCEPTED',
            'processed_on' => Carbon::now()
        ]);
        $orders = Order::with('user')->where('status','RECEIVED')->get();
        return view('admin/manage', compact('orders'));
    }

    public function reject($id)
    {
        Order::where('id', $id)->get()->first()->
        update([
            'status' => 'REJECTED',
            'processed_on' => Carbon::now()
        ]);
        $orders = Order::with('user')->where('status','RECEIVED')->get();
        return view('admin/manage', compact('orders'));
    }

    public function edit_order($id)
    {
        $callback = function($query) use ($id) {
            $query->where('id', $id);
        };

        $orders = OrderedItem::with('item')->with('order')
            ->whereHas('order', $callback )->get();
        $ords = Order::with('user')->where('id', $id)->get()->first();
        return view('admin/edit_order',compact('orders','ords'));
    }

    public function processed(){
        $orders = Order::with('user')->where('status','ACCEPTED')->orWhere('status' , 'REJECTED')->get();
        return view('admin/processed',compact('orders'));
    }


}
