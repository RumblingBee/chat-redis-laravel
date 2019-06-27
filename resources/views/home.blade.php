@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-8">
        <div class="container-fluid spark-screen">
            <div class="jumbotron">
                <h1 class="display-4">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>
            <form action="sendmessage" method="POST">
                <input type="hidden" name="_frends" ref="_frends" data-value='@json($friends)'/>
                <input type="hidden" name="_token" ref="_token" data-value="{{ csrf_token() }}"/>
                <input type="hidden" name="_user" ref="_user" data-value="{{ @Auth::user()->name }}"/>
                <div id="accordionExample">
                    <div class="card-columns">
                        <div class="card" v-for="conversation in conversations">
                            <div class="card-header" id="headingOne">
                                <h2>
                                    <button class="btn btn-link" type="button"  
                                            v-on:click="openConversation(conversation.channel)" 
                                            v-bind:data-target="'#'+conversation.channel" data-toggle="collapse"
                                            v-bind:aria-controls="conversation.channel" aria-expanded="true" >
                                        @{{ conversation.channel }}
                                    </button>
                                </h2>
                            </div>
                            <div v-bind:id="conversation.channel" v-bind:ref="conversation.channel" 
                                    class="collapse" v-bind:aria-labelledby="conversation.channel"> <!--data-parent="#accordionExample">-->
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
    <div class="col border-left">
        <div class="container">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li v-for="friend in friends" class="list-group-item">
                        <span v-if="friend.isConnected" class="badge badge-success">ok</span>
                        <span v-else="friend.isConnected" class="badge badge-danger">ko</span> @{{ friend.name }}
                        <button v-if="friend.alreadyOpen" class="btn btn-link" type="button"
                                v-on:click="closeConversation(friend.name)">Fermer la fenetre de chat</button>
                        <button v-else="friend.alreadyOpen" class="btn btn-link" type="button"
                                v-on:click="newConversation(friend.name)">Ouvrir une fenetre de chat</button>
                    </li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Tout Ouvrir</a>
                    <a href="#" class="card-link">Tout Fermer</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
