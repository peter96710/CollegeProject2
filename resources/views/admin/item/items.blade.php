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
                                <th scope="col">Item</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete/Backup</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $item)
                                <tr>
                                    <th scope="row">{{$item->name}}</th>
                                    <td><a class="btn btn-primary"  href="/admin/item/{{$item->id}}/edit">Update</a></td>
                                    <td>
                                        @if(!$item->deleted_at)
                                        <form action="{{ route('item_delete', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @else
                                            <form action="/admin/item/{{$item->id}}/restore" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Backup</button>
                                            </form>
                                        @endif
                                    </td>
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
