@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>clients</span>
                    <span class="addclient">add client ?</span> 
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($clients) > 0)
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <table class="table table-striped task-table">

                                    <!-- Table Headings -->
                                    <thead>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Contact Phone</th>
                                        <th>manage services</th>
                                        <th>delete/update</th>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr class="openclient" clientId='{{ $client->id }}'>
                                                <!-- Task Name -->
                                                <td class="table-text">
                                                    <div>{{ $client->Title }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $client->Description }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $client->status }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $client->Contact_Phone }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <a href="/userservecies/{{ $client->id }}" class="manageservices">manage</a>
                                                </td>
                                                <td class="table-text">
                                                    <button class="deleteClient">delete</button>
                                                    <button class="updateClient">update</button>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="col-xs-12">
                            <P>There are no clients</P>
                            <p class="addclient">add client ?</p>
                        </div>
                    @endif
                                    

                </div>
            </div>
        </div>
    </div>
    <div class="pop-up popupAddClient" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" action="{{route('client.store')}}" id="AddClientForm">   
            @csrf
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title" required>
            </div>
            <div class="form-group">
                <label for="status">status</label>
                <select class="form-control" id="status" name="status" id="exampleFormControlSelect1" required>
                    <option value="single">single</option>
                    <option value="engagged">engagged</option>
                    <option value="married">married</option>
                </select>
            </div>
            <div class="form-group">
                <label for="number">contact number</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="number" required>
            </div>
            <div class="form-group">
                <label for="startdate">contract start date</label>
                <input type="date" class="form-control" id="startdate" name="startdate"  placeholder="" required>

            </div>
            <div class="form-group">
                <label for="enddate">contract end date</label>
                <input type="date" class="form-control" id="enddate" name="enddate" placeholder="" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea  class="form-control" id="description" name="description" placeholder="description" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary submitbtn">Submit</button>
        </form>
    </div>
    <div class="pop-up popupUpdateClient" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" id="updateClientForm" action="{{route('client.update')}}">   
            @csrf
            <div class="form-group">
                <label for="titleShow">Title</label>
                <input type="text" class="form-control" id="titleShow" name="title" >
            </div>
            <div class="form-group">
                <label for="statusShow">status</label>
                <select class="form-control" id="statusShow" name="status" id="exampleFormControlSelect1">
                    <option value="single">single</option>
                    <option value="engagged">engagged</option>
                    <option value="married">married</option>
                </select>
            </div>
            <div class="form-group">
                <label for="numberShow">contact number</label>
                <input type="Telephone" class="form-control" id="numberShow" name="number" >
            </div>
            <div class="form-group">
                <label for="startdateShow">contract start date</label>
                <input type="date" class="form-control" id="startdateShow" name="startdate" >
            </div>
            <div class="form-group">
                <label for="enddateShow">contract end date</label>
                <input type="date" class="form-control" id="enddateShow" name="enddate" >
            </div>
            <div class="form-group">
                <label for="descriptionShow">Description</label>
                <textarea class="form-control" id="descriptionShow" name="description" ></textarea>
            </div>
            <input type="text" hidden name="id" id="id">
            <button type="submit" class="btn btn-primary submitbtn">update</button>
        </form>
    </div>
</div>


@endsection





@section('script')
<script>
    $('.close-popup').click(function (event) {
        $(".pop-up").fadeOut();
    })
    $('.addclient').click(function (event) {
        $(".popupAddClient").fadeIn();
    })
    $('.updateClient').click(function (event) {
        
        var id=$(this).parent().parent().attr("clientid")*1;
        console.log(id);
        $.ajax({
          url: "/digimedia/getClient/"+id,
          type:"GET",
          success:function(response){
            console.log(response);
            $("#updateClientForm").find("#id").val(response.client.id);
            $("#updateClientForm").find("#titleShow").val(response.client.Title);
            $("#updateClientForm").find("#descriptionShow").val(response.client.Description);
            $("#updateClientForm").find("#statusShow").val(response.client.status);
            $("#updateClientForm").find("#numberShow").val(response.client.Contact_Phone);
            $("#updateClientForm").find("#startdateShow").val(response.client.Contract_Start_Date);
            $("#updateClientForm").find("#enddateShow").val(response.client.Contract_End_Date);
            
            $(".popupUpdateClient").fadeIn();
        },
         });
    })

    $('.deleteClient').click(function (event) {
        
        var id=$(this).parent().parent().attr("clientid")*1;
        console.log(id);
        $.ajax({
          url: "/digimedia/deleteClient",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            "id":id
            },
         });
    })


    jQuery(function () {
        $('submitbtn').click(function(e){

        })
    $("#number,#numberShow").keyup(function () {
        var VAL = this.value;

        var num = new RegExp('^[0-9]{11}$');
        $(".errornum").remove();
        $(this).after("<p class='errornum'>please enter valid number<p>");
        
        if (num.test(VAL)) {
            $(".errornum").html('Great, you entered a valid number');
        }
        else{
            $(".errornum").html('please enter valid number');
            console.log("eee")

        }
    });

    /*$( "#AddClientForm" ).submit(function( event ) {
        event.preventDefault();
        var VAL = $(this).find("#number").value();

        var num = new RegExp('^[0-9]{11}');

        if($(this).find(".errornum")){

        }
        if($(this).find(".errornum")){
            $(this).after("<p class='errornum'>please enter valid number<p>")
        }
        if (num.test(VAL)) {
            $(this).submit();
        }
        else{
            $(".errornum").html('please enter valid number');

        }
    }); */
});
</script>
@endsection
