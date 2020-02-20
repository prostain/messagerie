@extends('layouts.app')

@section('content')
<div class="">
    @include('pages.users', ['users' => $users])
</div>
@endsection
