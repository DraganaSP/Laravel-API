@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form>
                        Name:<input type="text" id="name"><br>
                        Email:<input type="text" id="email"><br>
                        <input type="submit" id="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="application/javascript">
    $(document).ready(function(){
        let tokens = {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api_token"]').attr('content')
        }

        $.get('/api/user/{{$id}}', tokens).then(function(data){
            $('#name').val(data.name);
            $('#email').val(data.email);
        })

        $(document).on('click', '#submit', function(e){
            e.preventDefault();
            $.post('/api/user/{{$id}}/update', {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                'api_token': $('meta[name="api_token"]').attr('content'),
                'name': $('#name').val(),
                'email': $('#email').val(),
                'id': {{$id}}
            }).then(function(data){
                if(data.success){
                    window.location = '/admin';
                }
            })
        })
    })
</script>
@endsection
