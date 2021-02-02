<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\OrderedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function showAll() {

        $items = Item::all();
        $categories = Category::all();
        return view('menu', compact('items','categories'));
    }

    public function category($id) {
        $result = CategoryItem::with('item')->where('category_id', $id)->get();
        $items = array();
        foreach ($result as $i) {
            $items[] = $i->item;
        }
        $categories = Category::all();
        return view('menu', compact('items','categories'));
    }

    public function new()
    {
        return view('admin/item/new');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string'],
            'description' => ['required'],
            'price' => ['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],

        ]);
        if ($validator->fails()) {
            return redirect('admin/item/new')
                ->withErrors($validator)
                ->withInput();
        }

        Item::create($request->all());
        $items = Item::all();
        $categories = Category::all();
        return view('menu', compact('items','categories'));
    }

    public function items()
    {
        $items = Item::withTrashed()->get();
        return view('admin/item/items', compact('items'));
    }

    public function delete(Request $request)
    {
        Item::where('id', $request->id)->delete();
        $items = Item::withTrashed()->get();
        return view('admin//item/items', compact('items'));
    }
    public function restore($id)
    {
        Item::where('id', $id)->restore();
        $items = Item::withTrashed()->get();
        return view('admin//item/items', compact('items'));
    }

    public function edit($id)
    {
        if(Item::withTrashed()->where('id', $id)->get()->first()->deleted_at){
            $items = Item::withTrashed()->get();
            return view('admin/item/items', compact('items'))->with('mess' ,"Sorry, it's deleted, you can't edit this item :( ");
        }
        $items = Item::withTrashed()->where('id', $id)->get()->first();
        return view('admin/item/edit', compact('items'));
    }

    public function update(Request $request)
    {
        if($request->deleted_at){
            $items = Item::withTrashed()->get();
            return view('admin/item/items', compact('items'))->with('mess' ,"Sorry, it's deleted, you can't edit this item :( ");
        }
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'name' => ['required','string'],
            'description' => ['required'],
            'price' => ['required','regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
        ]);
        if ($validator->fails()) {
            return redirect('admin/item/items')
                ->withErrors($validator)
                ->withInput();
        }
        Item::where('id', $request->id)
            ->update([
                'name' => $request->name ,
                'description' => $request->description,
                'price' => $request->price,
                ]);
        $items = Item::all();
        return view('admin/item/items', compact('items'));
    }

}
