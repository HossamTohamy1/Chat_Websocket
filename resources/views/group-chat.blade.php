@extends('layout.app')

@section('title', 'Group Chat: ' . $groupName)

@section('content')

<link rel="stylesheet" href="{{ url('/css/chat.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container content">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">Group Chat: {{ $groupName }}</div>
                <div class="card-body height3">
                    <ul class="chat-list" id="chat-section"></ul>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-10">
                    <input type="text" id="username" value="{{ $username }}" hidden>
                    <input type="text" id="groupName" value="{{ $groupName }}" hidden>
                    <input type="text" class="form-control" id="message" placeholder="Type your message here...">
                </div>
                <div class="col-2">
                    <button onclick="broadcastMethod()" class="btn btn-primary w-100" id="sendMessage">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>

@vite('resources/js/app.js')

<script>
    setTimeout(() => {
        const groupName = $('#groupName').val();

        window.Echo.channel('chatMessage')
            .listen('chat', (data) => {
                if (data.groupName !== groupName) return;

                let isMe = data.username === $('#username').val();
                let avatar = isMe ? 'avatar2' : 'avatar1';
                let direction = isMe ? 'out' : 'in';

                let newMessage = '';

            if (data.username === $('#username').val()) {
                newMessage = `
                    <li class="out">
                        <div class="chat-img">
                            <img alt="Avatar" src="https://bootdey.com/img/Content/avatar/avatar2.png">
                        </div>
                        <div class="chat-body">
                            <div class="chat-message">
                                <h5>${data.username}</h5>
                                <p>${data.message}</p>
                            </div>
                        </div>
                    </li>`;
            } else {
                newMessage = `
                    <li class="in">
                        <div class="chat-img">
                            <img alt="Avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                        </div>
                        <div class="chat-body">
                            <div class="chat-message">
                                <h5>${data.username}</h5>
                                <p>${data.message}</p>
                            </div>
                        </div>
                    </li>`;
            }

            $('#chat-section').append(newMessage);
        });
}, 200);

    function broadcastMethod() {
        $.ajax({
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: '{{ route('broadcast.chat') }}',
            type: 'POST',
            data: {
                username: $('#username').val(),
                msg: $('#message').val(),
                groupName: $('#groupName').val()
            },
            success: function () {
                $('#message').val('');
            },
            error: function (error) {
                console.error(error);
            }
        });
    }
</script>

@endsection
