@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <input type="text" name='search' id="search">

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="application/javascript">
var ajaxLoading = false;
    $(document).ready(function(){
        
        let tokens = {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api_token"]').attr('content')
        }
        if(!ajaxLoading) {
            ajaxLoading = true;
            $.get('/api/users', tokens).then(function(data){
                ajaxLoading = false;
                createTable(data);
            })
        }

        function createTable(data){
            let html = '';
            $('table tbody').html();
            data.forEach(user => {
                let buttons = '';
                if(user.role.id == 2){
                    buttons = `
                        <a class='btn btn-info' href='/edit/${user.id}'>Edit</a>
                        <button class='btn btn-danger' data-id='${user.id}'>Delete</button>
                    `
                }
                html += `<tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>
                                <a href='/show/${user.id}' class='btn btn-warning' data-id='${user.id}'>view</a>    
                                ${buttons}
                            </td>
                        </tr>`
            })
            $('table tbody').append(html)
        }
        $(document).on('click', '.btn-danger', function(){
            let id = $(this).attr('data-id');
            $('#table tbody').html('');
            $.post(`/api/user/${id}/delete`, tokens).then(function(data){
                if(!ajaxLoading) {
                    ajaxLoading = true;
                    $.get('/api/users', tokens).then(function(data){
                        ajaxLoading = false;
                        createTable(data);
                    })
                }
            })
        })

        $(document).on('keyup', '#search', function(){
            let val = $('#search').val();
            let params = {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                'api_token': $('meta[name="api_token"]').attr('content'),
                'search': val
            }
            $.post(`/api/user/search`, params).then(function(data){
                $('#table tbody').html('');
                createTable(data);
            })
        })
    })
</script>
@endsection