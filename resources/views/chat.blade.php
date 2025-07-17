@extends('layout.app')

@section('title', 'Chat Page')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHAT APP</title>
     <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ url('/css/chat.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
 <div class="container content">
    <div class="row  justify-content-center">
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
        	<div class="card">
        		<div class="card-header">Chat</div>
        		<div class="card-body height3">
        			<ul class="chat-list"id="chat-section">
        				
        			
        			</ul>
                    
                </div>
            </div>
            <div class="row mt-3" >
                <div class="col-lg-10">
                    <input type="text" id="username" value="{{ $username }}" hidden >

                    <input type="text" class="form-control" id="message" placeholder="Type your message here...">
                </div>
                <div class="col-2">
                    <button onclick="broadastMethod()" class="btn btn-primary w-100" id="sendMessage">Send</button>
                </div>
        	</div>
        </div>
       
    </div>
</div>

    @vite('resources/js/app.js')
    <script> 
       setTimeout(() => {
            window.Echo.channel('chatMessage').listen('chat', (data) => {
                console.log(data.username , $('#username').val(),data.username == $('#username').val());
                if(data.username == $('#username').val()) {
                    newMessage = `<li class="out">
                        <div class="chat-img">
                            <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar2.png">
                        </div>
                        <div class="chat-body">
                            <div class="chat-message">
                                <h5>${data.username}</h5>
                                <p>${data.message}</p>
                            </div>
                        </div>`;
                } else {                
                newMessage = `<li class="in">
                    <div class="chat-img">
                        <img alt="Avtar" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                    </div>
                    <div class="chat-body">
                        <div class="chat-message">
                            <h5>${data.username}</h5>
                            <p>${data.message}</p>
                        </div>
                    </div>`;
                }
                console.log(data);
                // console.log(data.username);
                $('#chat-section').append(newMessage);
            });
        }, 200);
        function broadastMethod() {
     

        $.ajax({
            'headers': {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            'url': '{{ route('broadcast.chat') }}',
            'type': 'POST',
            data: {
                username: $('#username').val(),
                msg: $('#message').val()
            },
            'success': function(result) {
                
                // console.log(result);
            },
            'error': function(error) {
                console.error(error);
             
            }
            
        })
        }
     
        </script>

</body>
</html>
@endsection