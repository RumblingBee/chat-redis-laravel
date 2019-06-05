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

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" >

                                <input type="hidden" name="user" value="{{ Auth::user()->name }}" >

                                <textarea class="form-control msg" v-bind:value="message"></textarea>

                                <br/>

                                <input type="button" value="Send" class="btn btn-success send-msg" v-on:click="reverseMessage">

                            </form>

                    </div>

                </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
