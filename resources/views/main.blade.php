@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('About') }}</div>

                    <div class="card-body">
                        <ul>
                            <li>Felhasználók: {{ $users }}</li>
                            <li>Kategóriák: {{ $categories }}</li>
                            <li>Tárgyak: {{ $items}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
