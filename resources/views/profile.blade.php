@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <ul>
                            <li>Felhasnzáló: {{ $user->name }}</li>
                            <li>E-Mail: {{ $user->email }}</li>
                            <li>Szerepkör:
                                @if($user->is_admin)
                                    Admin
                                @else
                                    Felhasználó
                                @endif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
