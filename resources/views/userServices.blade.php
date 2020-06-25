@extends('layouts.dashboard')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
   
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>the client info</span>
                </div>

                <div class="card-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped task-table clientInfo">
                                <!-- Table Body -->
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <td class="table-text">
                                            <div>{{ $clientData->Title }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td class="table-text">
                                            <div>{{ $clientData->Description }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>status</th>   
                                        <td class="table-text">
                                            <div>{{ $clientData->status }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contact Phone</th>
                                        <td class="table-text">
                                            <div>{{ $clientData->Contact_Phone }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contract Start Date</th>
                                        <td class="table-text">
                                            <div>{{ $clientData->Contract_Start_Date }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Contract End Date</th>
                                        <td class="table-text">
                                            <div>{{ $clientData->Contract_End_Date }}</div>
                                        </td>                                     
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>the services the client is subscribed</span>
                    <span class="addclient">add service ?</span> 
                </div>

                <div class="card-body">
                    @if (count($clientServices) > 0)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped task-table">
                                    <!-- Table Headings -->
                                    <thead>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        @foreach ($clientServices as $clientService)
                                            <tr class="openclient" serviceid='{{ $clientService->id }}'>
                                                <!-- Task Name -->
                                                <td class="table-text">
                                                    <div>{{ $clientService->Title }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $clientService->Type }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $clientService->Link }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $clientService->Description }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <button class="deleteService">delete</button>
                                                    <button class="updateService">update</button>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="col-xs-12">
                            <P>There are no services</P>
                            <p class="addclient">add service ?</p>
                        </div>
                    @endif
                                    

                </div>
            </div>
        </div>
    </div>
    <div class="pop-up popupAddClient" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" action="{{route('service.store')}}">   
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="Title" placeholder="title">
            </div>
            <div class="form-group">
                <label for="Type">Type</label>
                <input type="text" class="form-control"  name="Type" placeholder="description">
            </div>
            <div class="form-group">
                <label for="status">Link</label>
                <input type="text" class="form-control" id="" name="Link" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="Descritpion">contact number</label>
                <input type="text" class="form-control" id="" name="Description" placeholder="number">
            </div>
            <input type="text" hidden name="clientId" value="{{ $clientData->id }}">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="pop-up popupUpdateClient" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" id="updateClientForm" action="{{route('service.update')}}">   
            @csrf
            <div class="form-group">
                <label for="titleShow">Title</label>
                <input type="text" class="form-control" id="titleShow" name="Title" >
            </div>

            <div class="form-group">
                <label for="typeShow">contact number</label>
                <input type="text" class="form-control" id="typeShow" name="Type" >
            </div>
            <div class="form-group">
                <label for="descriptionShow">Description</label>
                <input type="text" class="form-control" id="descriptionShow" name="Description" >
            </div>
            <div class="form-group">
                <label for="linkShow">status</label>
                <input type="text" class="form-control" id="linkShow" name="Link" >
            </div>
            <input type="text" hidden name="clientId" value="{{ $clientData->id }}">
            <input type="text" hidden name="serviceId" value="" id="serviceId">
            <button type="submit" class="btn btn-primary">update</button>
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
    $('.updateService').click(function (event) {
        
        var id=$(this).parent().parent().attr("serviceid")*1;
        console.log(id);
        $.ajax({
          url: "/getService",
          type:"GET",
          data:{
            "_token": "{{ csrf_token() }}",
            "id":id
            },
          success:function(response){
            console.log(response);
            $("#serviceId").val(response.service.id);
            $("#titleShow").val(response.service.Title);
            $("#descriptionShow").val(response.service.Description);
            $("#typeShow").val(response.service.Type);
            $("#linkShow").val(response.service.Link);
            
            $(".popupUpdateClient").fadeIn();
        },
         });
    })

    $('.deleteService').click(function (event) {
        
        var id=$(this).parent().parent().attr("serviceid")*1;
        console.log(id);
        $.ajax({
          url: "/deleteService",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            "id":id
            },
         });
    })
</script>
@endsection
