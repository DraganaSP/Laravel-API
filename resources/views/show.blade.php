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
                    Name: <h3 id="name"></h3>
                    Email: <h3 id="email"></h3>
                    Id: <h3 id="id"></h3>
                    Role: <h3 id="role"></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="application/javascript">
    $(document).ready(function(){
        $.get('/api/user/{{$id}}', {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api_token"]').attr('content'),
            'id': {{$id}}
        }).then(function(data){
            $('#name').html(data.name);
            $('#email').html(data.email);
            $('#id').html(data.id);
            $('#role').html(data.role.name);
        })
    });
    </script>
@endsection
