@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Congratulations! Your link is saved</h2>

                <table class="table table-responsive">
                    <tr>
                    <td>Param1</td>
                    <td>{{$click->param1}}</td>
                    </tr>

                    <tr>
                    <td>Param1</td>
                    <td>{{$click->param2}}</td>
                    </tr>

                    <tr>
                    <td>IP</td>
                    <td>{{$click->ip}}</td>
                    </tr>

                    <tr>
                    <td>Referer</td>
                    <td>{{$click->ref}}</td>
                    </tr>

                    <tr>
                    <td>Created at</td>
                    <td>{{$click->created_at}}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
@endsection
