@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Delete category') }}</div>

                    <div class="card-body">
                        @foreach ($errors->all() as $error)

                            <div>{{ $error }}</div>

                        @endforeach
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Update</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$category->name}}</th>
                                <td><a class="btn btn-primary"  href="/admin/category/{{$category->id}}/edit">Update</a></td>
                                <td>
                                    <form action="{{ route('category_delete', ['id' => $category->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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
