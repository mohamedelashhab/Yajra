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




@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
       
      
        $("#tasks").DataTable(
            {
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
                            return "<button class='btn-link js-delete' data-vehicle-id=" + data + ">Delete</button>";
                        }
                    }
                ]
            })
        $("#vehicles").on('click', '.js-delete', function () {
            var button = $(this);

            $.ajax(
                {
                    url: "/api/vehicles/" + button.attr("data-vehicle-id"),
                    method: "DELETE",
                    success: function () {
                        button.parents("tr").remove();
                        alert("successfully deleted");
                    }
                });

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



