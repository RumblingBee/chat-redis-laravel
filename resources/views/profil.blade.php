@extends('layouts.app')

@section('content')

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>


<div class="container spark-screen">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">
                    <h2> Profil de {{ Auth::user()->name }} </h2> <i> ({{ Auth::user()->id }}) </i>
                </div>

                <div class="panel-body">



                    <div class="row">

                        <div class="col-lg-8">

                            <p> {{ Auth::user()->email }} </p>

                        </div>


                        <div class="col-lg-8" id="friendList">
                            <h5> Liste d'amis: </h5>


                        </div>



                        <div class="col-lg-8">

                            <form action="addFriend"   method="POST">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <br/><br/>
                                <div id="friendsForm"></div>

                                <br /><br/>

                                <input type="submit" value="Ajouter" class="btn btn-success send-msg">

                            </form>
                            <br/>
                            <form action="deleteAccount"   method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <input type="submit" value="Supprimer mon compte" class="btn btn-danger send-msg">

                            </form>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>


// Liste des utilisateurs
$.ajax({

type: "GET",

url: '{!! URL::to("listUsers") !!}',


}).then(function(data){

    var intputSelect = '<select name="friendId" class="form-control" >';


   data.forEach(function (element) {

        intputSelect += '<option value="' + element['_id'] +'">'+ element['name'] +' </option>'

    });

intputSelect += '</select>';

$('#friendsForm').append(intputSelect);

});

// Liste des amis
$.ajax({

type: "GET",

url: '{!! URL::to("listFriends") !!}',



}).then(function(data){


    if(data.length > 0 ){
    var htmlTable = '';

   data.forEach(function (element) {

       console.log('test');

    htmlTable += '<form action="deleteFriend"  method="POST">';
    htmlTable += '<tr> ';
    htmlTable += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
    htmlTable += '<td>' + element +' </td>';
    htmlTable += '<td><input type="hidden" name="userId" value="' + element +'"></td>' ;
    htmlTable += '<td><input type="submit" value="supprimer" class="btn btn-danger"> </td>'
    htmlTable += '</form></tr> ';

    });

    htmlTable += '</table>';
    console.log(htmlTable);

$('#friendList').append(htmlTable).fadeIn("slow");

}
else{

    $('#friendList').append('Vous n\'avez pas d\'amis actuellement.').fadeIn("slow");
}
}
);




</script>

@endsection
