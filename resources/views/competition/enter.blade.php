@extends('layouts.default')

@section('content')
    <form method="post" action="{{url('enter/upload') }}" >
        <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
        <label>First Name</label><input type="text" name="first_name">
        <label>Last Name</label><input type="text" name="last_name">
        <label>Email</label><input type="text" name="email">
        <input type="submit" name="Submit">
    </form>
@endsection