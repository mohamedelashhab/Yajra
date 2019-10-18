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
            <th>content</th>
            <th>description</th>
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
<input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />






@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
       
      
        $("#tasks").DataTable(
            {
                "scrollX": true,
                "scrollY": 500,
                ajax:
                {
                    url: '{!! route('task.list') !!}',
                    dataSrc: ""
                },
                columns:
                [
                    {
                        data: "id",

                    },
                    {
                        data: "name",
                    },
                    {
                        data: "image",
                        "orderable": false,
                        "searchable":false,
                        render: function(data, type, row){
                           
                            return row.id;
                        }

                    },
                    {
                        data: "screen_name",
                    },
                    {
                        data: "content",
                    },
                    {
                        data: "description",
                    },
                    {
                        data: "user_name",
                    },
                    {
                        data: "created_at",
                    },
                    {
                        data: "statuse",
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



        $("#vehicles").on('click', '.js-update', function () {
            var button = $(this);
     
            $.ajax(
                {
                    url: "/vehicles/" + button.attr("data-vehicle-id"),
                    method: "GET",
                    success: function(data){
                        window.location = "/vehicles/" + button.attr("data-vehicle-id");
                    }
                });

        });



    });




</script>

@endsection



