@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tárgyak') }}</div>
                    <div class="card-body">
                        <div class="row mb-4">
                            @foreach ($categories as $categorie)
                                <a href="/menu/category/{{$categorie->id}}"
                                   class="badge badge-primary">{{$categorie->name}}</a>
                            @endforeach
                        </div>
                        <div class="row">
                            @forelse ($items as $item)
                                <div class="col-12 col-lg-4 mb-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text">{{$item->description}}</p>
                                            <form method="POST" action="/cart/add">
                                                @csrf
                                                <input type="hidden" name='id' value='{{ $item->id }}'>
                                                <input @guest disabled @endguest name="quantity" min="1" value="1" max="10"
                                                       type="number">
                                                <button @guest disabled @endguest type="submit" class="btn btn-primary">
                                                    {{ __('Kosárba') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Még nincsenek bejegyzések</p>
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
