@extends('layout')

@section('content')
    <div class="row">
        <form action="" method="post">
            <label for="">
                username
                <input type="text" name="username" class="form-control">
            </label>
            <label for="">
                phone
                <input type="text" name="phone" class="form-control">
            </label>
            <input type="submit" class="btn btn-primary">
            @csrf
        </form>
    </div>
@endsection
