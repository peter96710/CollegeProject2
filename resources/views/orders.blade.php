@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}</div>
                    <div class="card-body">
                    <div class="row">
                        @forelse ($ordering as $ord)
                            @php
                                $price = 0;
                            @endphp
                            <div class="col-12 col-lg-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        @foreach($orders as $order)
                                            @if($ord->id == $order->order_id)
                                                <h5  @if($order->item->deleted_at) class="text-danger"@endif class="card-title">{{ $order->item->name }}</h5>
                                                @php
                                                    $price +=  $order->item->price
                                                @endphp
                                            @endif
                                        @endforeach
                                        <p class="card-text">  Állapot: {{$ord->status}}</p>
                                            <p class="card-text"> Rendelés Összege: {{$price}}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Nincsenek Rendeléseid</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
@endsection
