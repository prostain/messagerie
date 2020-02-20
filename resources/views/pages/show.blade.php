@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('pages.users', ['users' => $users])
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    {{ $user->name }}
                </div>
                <div class="card-body">
                    <div class="conversations" id="bottom_scroll">
                        @foreach ($messages as $message)
                            @if($message->from_id === $user->id)
                                <div class="chat">
                                    <img src="{{ asset('user-profile.png') }}" alt="Avatar" style="width:100%;">
                                    <p>{{ $message->content }}</p>
                                    <span class="time-right">{{ $message->created_at }}</span>
                                </div>
                            @else
                                <div class="chat chat_send">
                                    <img src="{{ asset('user-profile.png') }}" alt="Avatar" class="right" style="width:100%;">
                                    <p>{{ $message->content }}</p>
                                    <span class="time-left">{{ $message->created_at }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="sendmessage">
                        <form method="POST" action="{{ route('send') }}">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="to_id">
                            <input class="input_send" type="text" name="content" placeholder="Entrez un message..." />
                            <input type="submit" class="input_submit" value="Envoyer">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function () {
        element = document.getElementById('bottom_scroll');
        element.scrollTop = element.scrollHeight;
    };
    </script>
@endsection
