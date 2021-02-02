<?php

namespace App\Http\Controllers;

use App\Models\CategoryItem;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderedItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function add(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => ['required','integer'],
            'quantity' => ['required' , 'integer'],
        ]);

        if ($validator->fails()) {
            return redirect('cart')
                ->withErrors($validator)
                ->withInput();
        }

        $callback = function($query) {
            $query->where('user_id', Auth::id())->where('status','CART');
        };

        $input = OrderedItem::with('item')->with('order')
            ->where('item_id', $request->id)
            ->whereHas('order', $callback )->get()->first();

        if($input){
            OrderedItem::where('id', $input->id)
                ->increment('quantity' , $request->quantity);
            return redirect()->route('cart');
        }
        $hascart = Order::where('user_id', Auth::id())->where('status','CART')->get();
        if($hascart->isEmpty()){
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'CART',
            ]);
            OrderedItem::create([
                'item_id' => $request->id,
                'order_id' => $order->id,
                'quantity' => $request->quantity,
            ]);
        }else{
            OrderedItem::create([
                'item_id' => $request->id,
                'order_id' => $hascart->first()->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart');
    }
    public function cart(){
        $callback = function($query) {
            $query->where('user_id', Auth::id())->where('status','CART');
        };

        $orders = OrderedItem::with('item')->with('order')
            ->whereHas('order', $callback )->get();
        $price = 0;
        foreach($orders as $item){
            $price = $price + $item->item->price;
        };

        return view('cart' ,compact('orders','price') );
    }
    public function destroy($id)
    {
        OrderedItem::where('id', $id)->delete();
        $hascart = Order::where('user_id', Auth::id())->where('status','CART')->get()->first();
        $hascart2 = OrderedItem::where('user_id', $hascart->id)->get();

        if($hascart2->isEmpty()){
            Order::where('id', $hascart->id)->delete();
        }
        return redirect()->route('cart');
    }
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => ['required','string'],
            'payment_method' => ['required' ,'in:CASH,CARD'],
        ]);
        if ($validator->fails()) {
            return redirect('cart')
                ->withErrors($validator)
                ->withInput();
        }
        $hascart = Order::where('user_id', Auth::id())->where('status','CART')->get()->first();
        Order::where('id', $hascart->id)
            ->update([  'status' => 'RECEIVED',
                        'address' => $request->address,
                        'payment_method' => $request->payment_method,
                        'comment' => $request->description,
                        'received_on' => Carbon::now()]);
        return redirect()->route('cart');

    }

}
