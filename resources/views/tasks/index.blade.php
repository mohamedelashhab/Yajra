@extends('layouts.app')

@section('title')
    datatables
@endsection


@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}" />

@endsection

@section('src_script')
<script src="{{asset('js/app.js')}}"></script>
@endsection

@section('content')
    

<div class="wrapper">
        
        <table id="tasks" class="table" >
                <span class="scroll left-scroll"> &#171;</span>
                <span class="scroll right-scroll">&#187;</span>  
                <thead class="">
                    <tr>
            
                        <th>Delete</th>
                        <th>id</th>
                        <th>name</th>
                        <th>image</th>
                        <th>screen_name</th>
                        <th>user_name</th>
                        <th>date</th>
                        <th>statuse</th>
                        <th>Edit</th>
                        
                        
                    </tr>
                </thead>
                
                <tbody></tbody>

                

                
        </table>         
</div>



<div class="jumbotron">
        <div class="row">
           
            <div class="col-md-8 col-sm-6">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
            </div>
            


            <div class="col-md-2 col-sm-2">
                <button class="btn btn-default filterDate" value="Filter">Filter</button>
            </div>

        </div>
        <hr>
        <div class="row">
                <div style='position: absolute; center: 0;  padding: 0 0 0 0;'
                 class="col-md-6 col-sm-6"><a href="{{route('task.create')}}"><button class="btn btn-primary" ><i class="fa fa-plus" aria-hidden="true"></i> Add New Task</button></a></div>

        </div>
        
        
            
     
    
    </div>

{{--  <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />  --}}





@endsection


@push('script')
<!-- JS -->
{{--  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>  --}}
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
@endpush

@push('script')

<script type="text/javascript">
    

    var sortType = 'DESC';
    var filterBy = '';
    var deleteFlag = 0;
    var start = '';
    var end = '';
    $(document).ready(function () {
        $('.daterange').daterangepicker();
        
        var table = $("#tasks").DataTable({

            {{-- table options --}}

          
            buttons: ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
            

            {{-- end options --}}
                "sScrollX": "100%",
                "sScrollXInner": "110%",
                "bScrollCollapse": true,
                "fixedColumns":   {
                "leftColumns": 1
                },
                processing: true,
                serverSide: true,
                "scrollX": true,
                "scrollY": 400,
              
                ajax:
                {
                    url: '{!! route('task.list') !!}',
                    data: function(d){
                        d.start_date = start;
                        d.end_date = end;
                        d.filterBy = filterBy;
                        d.sortType = sortType;
                        dataSrc: d.data;
                    },
                    type: 'GET',
                    
                },
                columns:
                [
                    {
                        data: "id",
                        "searchable":false,
                        "orderable": false,
                        render: function (data)
                        {
                            return "<input type='checkbox' class='form-control' name='tasks[]' value=" + data + ">";
                            
                            
                        }
                    },

                    {
                        data: "id",
                        "class": "data_id"
                    },
                    
                    {
                        data: "name",
                        "class" : "data menu",
                    },
                    {
                        data: "image",
                        "orderable": false,
                        "searchable":false,
                        "class" : "data",
                        render: function(data, type, row){
                            
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
                    
                ]
            });

            {{-- buttons --}}

            {{-- get first  child of tasks_wrapper --}}
            $('#tasks_wrapper').children().first().children().eq(0).removeClass("col-md-6").addClass("col-md-1");
            $('#tasks_wrapper').children().first().children().eq(1).removeClass("col-md-6").addClass("col-md-10");
            var leftCol = $('#tasks_wrapper').children().first().children().eq(0).append(`<div class="col-md-1"><button class="js-delete2" disabled><i class="fa fa-trash" aria-hidden="true"></i>
            </button></div>`);

            $('#tasks_length').remove();


            var sortByLabelHtml = `<div class="col-md-3 dataTables_filter">
                    <select id="tasks_filterBy" class="form-control form-control-sm" placeholder="sort by label" aria-controls="tasks" style="height:auto;font-size:12px;">
                            <option value=""  disabled selected>Sort by label</option>
                            <option value="name">name</option>
                            <option value="user_name">User name</option>
                            <option value="statuse">statuse</option>
                            <option value="created_at">date</option>
                    </select>
            </div>`;

            var sortTypeHtml = `<div class="col-md-3 dataTables_filter">
                    <select id="tasks_filterType" class="form-control form-control-sm" placeholder="Sort type" aria-controls="tasks" style="height:auto;font-size:12px;">
                            <option value=""  disabled selected>Sort Type</option>
                            <option value="ASC">ASC</option>
                            <option value="DESC">DESC</option>
                    </select>
            </div>`;

            $('#tasks_filter').parent().append(sortByLabelHtml);
            $('#tasks_filter').parent().prepend(sortTypeHtml);
        
            {{-- end buttons --}}

        $(".js-delete2").on('click', function () {
            if(confirm("Are you sure you want to delete tasks ? ")){
                deleteFlag= 0;
                $('.js-delete2').attr("disabled", true);
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

        

        $("#tasks").on('change',':checkbox', function(){

            if(this.checked) {
                deleteFlag++;
            }      
            else{
            
                deleteFlag--;
            }  

            if(deleteFlag > 0) {
                $(".js-delete2").removeAttr("disabled");
            }else{
                $(".js-delete2").attr("disabled", true);
            }
        });


        $("#tasks").on('click', 'tr .data', function(){
            let id = $(this).siblings(".data_id").text();

            window.location = "/tasks/" + id + "/show";

        });

        $('.filterDate').on('click', function(){

           console.log(sDate, eDate);

           start = sDate;
           end = eDate;

           {{-- var res = $('input[name="daterange"]')[0]['value'];
           var arr = res.split("-");
           start = arr[0].trim();
           end = arr[1].trim(); --}}
           $('#tasks').DataTable().draw(true);
           
        });

        $('select#tasks_filterBy').on('change', function(){
            filterBy =  $(this).children("option:selected")[0]['value'];
            $('#tasks').DataTable().draw(true);
        });
        $('select#tasks_filterType').on('change', function(){
            sortType =  $(this).children("option:selected")[0]['value'];
            $('#tasks').DataTable().draw(true);
        });

        var colIndex = 0;
        var widths = [];
        $('.dataTable thead th').each(function() {
            widths.push(parseInt(this.style.width)+16);
        })

        $(".right-scroll").on('click', function() {
            
            if (colIndex == widths.length-1) return;
            document.querySelector('.dataTables_scrollBody').scrollLeft += widths[colIndex];
            colIndex++;
        }) 
        $(".left-scroll").on('click', function() {
            if (colIndex == 0) return;
            colIndex--;        
            var scrollLeft = 0;
            for (var i=0;i<colIndex;i++) { scrollLeft+=widths[i] }
            document.querySelector('.dataTables_scrollBody').scrollLeft = scrollLeft;
        }) 

        

        
        

    });


    




</script>

@endpush





