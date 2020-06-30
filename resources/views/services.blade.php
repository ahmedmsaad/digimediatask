@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>services</span>
                    <span class="addservice">add service ?</span> 
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($services) > 0)
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <table class="table table-striped task-table">

                                    <!-- Table Headings -->
                                    <thead>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>User</th>
                                        <th>Link</th>
                                        <th>Description</th>
                                        <th>delete/update</th>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        @foreach ($services as $service)
                                            <tr class="openservice" serviceId='{{ $service->id }}'>
                                                <!-- Task Name -->
                                                <td class="table-text">
                                                    <div>{{ $service->Title }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $service->Type }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div></div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $service->Link }}</div>
                                                </td>
                                                <td class="table-text">
                                                    <div>{{ $service->Description }}</div>
                                                </td>

                                                <td class="table-text">
                                                    <a href="/digimediatask/deleteService/{{$service->id}}" class="deleteService">delete</a>
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
                            <p class="addservice">add services ?</p>
                        </div>
                    @endif
                                    

                </div>
            </div>
        </div>
    </div>
    <div class="pop-up popupAddService" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" action="{{route('service.store')}}">   
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="Title" placeholder="title" required>
            </div>
            <div class="form-group">
                <label for="Type">Type</label>
                <input type="text" class="form-control" id="Type" name="Type" placeholder="Type" required>
            </div>
            <div class="form-group">
                <label for="Link">Link</label>
                <input type="text" class="form-control" id="Link" name="Link" placeholder="https://www.example.com" required>
            </div>
            
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" id="Description" name="Description" placeholder="Description" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="pop-up popupUpdateService" >
        <p class="col-xs-12 close-popup">close</p>
        <form  method="POST" id="updateServiceForm" action="{{route('service.update')}}">   
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="Titleshow" name="Title" placeholder="title" required>
            </div>
            <div class="form-group">
                <label for="Type">Type</label>
                <input type="text" class="form-control" id="Typeshow" name="Type" placeholder="Type" required>
            </div>
            <div class="form-group">
                <label for="Link">Link</label>
                <input type="text" class="form-control" id="Linkshow" name="Link" placeholder="https://www.example.com" required>
            </div>
            
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" id="Descriptionshow" name="Description" placeholder="Description" required>
            </div>
            <input type="text" hidden name="id" id="id">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>


@endsection





@section('script')
<script>
    $('.close-popup').click(function (event) {
        $(".pop-up").fadeOut();
    })
    $('.addservice').click(function (event) {
        $(".popupAddService").fadeIn();
    })
    $('.updateService').click(function (event) {
        
        var id=$(this).parent().parent().attr("serviceid")*1;
        console.log(id);
        $.ajax({
          url: "/digimediatask/getService/"+id,
          type:"GET",
          success:function(response){
            console.log(response);
            $("#updateServiceForm").find("#id").val(response.service.id);
            $("#updateServiceForm").find("#Titleshow").val(response.service.Title);
            $("#updateServiceForm").find("#Typeshow").val(response.service.Type);
            $("#updateServiceForm").find("#Linkshow").val(response.service.Link);
            $("#updateServiceForm").find("#Descriptionshow").val(response.service.Description);

            
            $(".popupUpdateService").fadeIn();
        },
         });
    })
    $("#Link,#Linkshow").keyup(function () {
        var VAL = this.value;

        var num = new RegExp('^https://www.[a-z 0-9]+.com');
        $(".errorlink").remove();
        $(this).after("<p class='errorlink'>please enter valid Link<p>");
        
        if (num.test(VAL)) {
            $(".errorlink").html('Great, you entered a valid Link');
        }
        else{
            $(".errorlink").html('please enter valid Link');
            console.log("eee")

        }
    });

   /* $('.deleteService').click(function (event) {
        
        var id=$(this).parent().parent().attr("serviceid")*1;
        console.log(id);
        $.ajax({
          url: "/digimedia/deleteService",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            "id":id
            },
            success: function(result) {
                 location.href = "digimedia/services"
            }
         });
    })*/
</script>
@endsection
