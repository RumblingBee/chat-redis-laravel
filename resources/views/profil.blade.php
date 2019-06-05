@extends('layouts.app')

@section('content')

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>


<div class="container spark-screen">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading"><h2> Profil de {{ Auth::user()->name }} </h2></div>

                <div class="panel-body">



                <div class="row">

                    <div class="col-lg-8" >

                 <p> {{ Auth::user()->email }}  </p>

                    </div>


                    <div class="col-lg-8" >
                        <h5> Liste d'amis: </h5>
                        <p>  Pas d'amis renseignés actuellement.</p>



                    </div>

                </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    var socket = io.connect('http://localhost:8890');

    socket.on('message', function (data) {

        data = jQuery.parseJSON(data);

        console.log(data.user);

        $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );

      });

    $(".send-msg").click(function(e){
        alert('ok!');

        e.preventDefault();

        var token = $("input[name='_token']").val();

        var user = $("input[name='user']").val();

        var msg = $(".msg").val();

        if(msg != ''){

            $.ajax({

                type: "POST",

                url: '{!! URL::to("sendmessage") !!}',

                dataType: "json",

                data: {'_token':token,'message':msg,'user':user},

                success:function(data){

                    console.log(data);

                    $(".msg").val('');

                }

            });

        }else{

            alert("Please Add Message.");

        }

    })

</script>

@endsection
