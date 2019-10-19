@extends('layouts.app')

@section('title')
    datatables
@endsection

@section('content')
    


<table id="tasks" class="table" >
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>image</th>
            <th>screen_name</th>
            <th>user_name</th>
            <th>date</th>
            <th>statuse</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>
<a href="{{route('task.create')}}"><button class="btn btn-primary" >Add Task</button></a>
<button class="btn btn-danger js-delete">Delete</button>
{{--  <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />  --}}







@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
       
      
        var table = $("#tasks").DataTable(
            {
                "scrollX": true,
                "scrollY": 400,
                ajax:
                {
                    url: '{!! route('task.list') !!}',
                    data: function(d){
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    },
                    dataSrc: ""
                },
                columns:
                [
                    {
                        data: "id",
                        "class" : "data_id",

                    },
                    {
                        data: "name",
                        "class" : "data",
                    },
                    {
                        data: "image",
                        "orderable": false,
                        "searchable":false,
                        "class" : "data",
                        render: function(data, type, row){
                            console.log('<img src={!! asset("uploads/images") !!}' +'/'+ data +  '">');
                            
                            return '<img src={!! asset("uploads/images") !!}' +'/'+ data +  ' width=100 height=50>';
                        }

                    },
                    {
                        data: "screen_name",
                        "class" : "data",
                    },
                    
                    {
                        data: "user_name",
                        "class" : "data",
                    },
                    {
                        data: "created_at",
                        "class" : "data",
                    },
                    {
                        data: "statuse",
                        "class" : "data",
                    },
                    

                    {
                        data: "id",
                        "orderable": false,
                        "searchable":false,
                        
                        render: function (data, type, row) {
                             return "<button class='btn-link js-update' data-vehicle-id=" + data + ">Edit</button>";
                           
                        }
                    },
                    {
                        data: "id",
                        "searchable":false,
                        "orderable": false,
                        render: function (data)
                        {
                            return "<input type='checkbox' class='' name='tasks[]' value=" + data + ">";
                            
                            
                        }
                    }
                ]
            })
        $(".js-delete").on('click', function () {
            
            if(confirm("Are you sure you want to delete tasks ? ")){
                var button = $(this);
                var val = [];
                $(':checkbox:checked').each(function(i){
                    var ch = $(this);
                    val[i] = $(this).val();
                    $.ajax({
                        url: "/tasks/"+ val[i] + "/delete",
                        method: "Delete",
                        data:{
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data){
    
                        }
                    });
                    console.log(val[i]);
                    ch.parents("tr").remove();
                });
            }
            

        });



        $("#tasks").on('click', '.js-update', function () {
            var button = $(this);
     
            $.ajax(
                {
                    url: "/tasks/" + button.attr("data-vehicle-id"),
                    method: "GET",
                    success: function(data){
                        window.location = "/tasks/" + button.attr("data-vehicle-id");
                    }
                });

        });

        

        $("#search").on('click', function(){
            

        });


        $("#tasks").on('click', 'tr .data', function(){
            let id = $(this).siblings(".data_id").text();

            window.location = "/tasks/" + id + "/show";

        });

    });




</script>

@endsection



