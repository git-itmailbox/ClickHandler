@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Sorry! You have already saved this link</h2>
                @if($redirectGoogle)
                    {{--<script> setTimeout(function(){window.location="http://google.com"}, 5000); </script>--}}
                    {{header("Refresh:5; url='//google.com'")}}
                    <p>Redirecting to Google...</p>
                @endif
            </div>
        </div>
    </div>
@endsection
