@extends('layouts.app')

@section('content')

<div class="container spark-screen">
    <div class="row">
        <form action="sendmessage" method="POST">
            <input type="hidden" name="_token" ref="_token" data-value="{{ csrf_token() }}"/>
            <input type="hidden" name="_user" ref="_user" data-value="{{ Auth::user()->name }}"/>
            <div id="accordionExample">
                <div class="card-columns">
                    <div class="card" v-for="conversation in conversations">
                        <div class="card-header" id="headingOne">
                            <h2>
                                <button class="btn btn-link" type="button" data-toggle="collapse" v-bind:data-target="'#'+conversation.channel" 
                                        aria-expanded="true" v-bind:aria-controls="conversation.channel">
                                @{{ conversation.channel }}
                                </button>
                            </h2>
                        </div>

                        <div v-bind:id="conversation.channel" class="collapse" v-bind:aria-labelledby="conversation.channel"> <!--data-parent="#accordionExample">-->
                            <div class="card-body">
                                <div v-for="message in conversation.messages">
                                    <div v-if="message.author === user">
                                        <div class="alert alert-primary" role="alert">
                                            <blockquote class="blockquote">
                                                <p>@{{ message.text }}</p>
                                                <hr>
                                                <footer class="blockquote-footer">
                                                    <small class="text-muted">
                                                    @{{ message.date }} <cite title="DateString">@{{ message.time }}</cite>
                                                    </small>
                                                </footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-secondary" role="alert">
                                            <blockquote class="blockquote">
                                                <p>@{{ message.text }}</p>
                                                <hr>
                                                <footer class="blockquote-footer">
                                                    <small class="text-muted">
                                                    @{{ message.date }} <cite title="DateString">@{{ message.time }}</cite>
                                                    </small>
                                                </footer>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <textarea class="form-control msg" v-model:value="conversation.message"></textarea>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-lg"
                                                v-on:click="sendMessage(conversation.channel, conversation.message)">></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form> 
    </div>
</div>

@endsection
