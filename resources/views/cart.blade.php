@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Kosár') }}</div>

                    <div class="card-body">
                        <div class="row mb-4">
                        </div>
                        <div class="row">
                            @foreach ($errors->all() as $error)

                                <div class="alert alert-warning"> {{ $error }}</div>

                            @endforeach
                        </div>
                        <div class="row">
                            @forelse ($orders as $order)
                                <div class="col-12 col-lg-4 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $order->item->name }}</h5>
                                            <p class="card-text">{{$order->item->price}} Ft.</p>
                                            <p class="card-text">{{$order->quantity}} DB.</p>

                                            <form action="/cart/destroy/{{$order->id}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Kidobás</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Üres a Kosarad</p>
                            @endforelse
                        </div>
                        <div class="mb-4">
                            @if(!$orders->isEmpty())
                                <h1>Teljes ár:{{$price}}</h1>

                                <form method="POST" action="/cart/send">
                                    @csrf
                                    {{--                                    <input type="hidden" name='orderid' value='{{ $order->id }}'>--}}
                                    <div class="form-group">
                                        <label for="address">Cím</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               placeholder="Cím">
                                        <small id="emailHelp" class="form-text text-muted">Kérjük adja meg a
                                            címét.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Megjegyzés</label>
                                        <input type="textarea" class="form-control" id="address" name="description"
                                               placeholder="Megjegyzés">
                                        <small id="emailHelp" class="form-text text-muted">Amennyiben megjegyzése van
                                            kérjük tudassa velünk</small>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cash"
                                               value="CASH" checked>
                                        <label class="form-check-label" for="cash">
                                            CASH
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="card"
                                               value="CARD">
                                        <label class="form-check-label" for="card">
                                            CARD
                                        </label>
                                    </div>
                                    <button @guest disabled @endguest type="submit" class="btn btn-primary">
                                        {{ __('Megrendelem') }}
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
