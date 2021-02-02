@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kosár') }}</div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-warning"> {{ $error }}</div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 mb-4 ">
                                <p class="card-text">User: {{$orders->first()->order->user->name}}</p>
                                <p class="card-text">Email: {{$ords->user->email}}</p>
                                <p class="card-text">Order Date: {{$ords->received_on}}</p>
                                <p class="card-text">Address: {{$ords->address}}</p>
                                <p class="card-text">Comment: {{$ords->comment}}</p>
                                <hr/>
                            </div>
                            @foreach($orders as $order)
                                <div class="col-12 mb-4 ">
                                            <h5 class="card-title">{{ $order->item->name }}</h5>
                                            <p class="card-text">{{$order->item->price}} Ft.</p>
                                            <p class="card-text">{{$order->quantity}} DB.</p>
                                            <hr/>
                                </div>
                            @endforeach
                        </div>
                                @if($ords->status == 'ACCEPTED' || $ords->status == 'REJECTED')
                                    <p class="card-text">Order Processed</p>
                                @elseif($ords->status == 'RECEIVED')
                                    <form class="mb-2" action="/admin/manage/accept/{{$ords->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">Accept</button>
                                    </form>

                                    <form action="/admin/manage/reject/{{$ords->id}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger">Reject</button>
                                    </form>
                                @endif
                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection
