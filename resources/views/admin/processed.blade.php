@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Delete item') }}</div>

                    <div class="card-body">
                        @if(!empty($mess))
                            <div class="alert alert-warning"> {{ $mess }}</div>
                        @endif
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-warning"> {{ $error }}</div>
                        @endforeach
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Item_ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Comment</th>
                                <th scope="col">Address</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Check</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->comment}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->payment_method}}</td>
                                    <td><a class="btn btn-outline-primary"  href="/admin/manage/edit/{{$order->id}}">{{ __('Check') }}</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
