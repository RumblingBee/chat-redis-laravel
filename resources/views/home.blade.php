@extends('layouts.app')

@section('content')

<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Chat Message Module</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8" >
                            <div id="messages" ></div>
                        </div>
                        <div class="col-lg-8" >
                            <form action="sendmessage" method="POST">
                                <input type="hidden" name="_token" ref="_token" data-value="{{ csrf_token() }}" >
                                <input type="hidden" name="_user" ref="_user" data-value="{{ Auth::user()->name }}" >
                                <textarea class="form-control msg" v-model:value="message"></textarea>
                                <br/>
                                <input type="button" value="Send" class="btn btn-success send-msg" v-on:click="sendMessage">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
