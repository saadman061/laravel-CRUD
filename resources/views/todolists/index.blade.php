@extends('layouts.app')
@section('title', 'View All To Do List')

@section('customJavascript')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
	
  <script type="text/javascript">
    $(document).ready(function(){
      
      var table = $('#to-do-list-table').DataTable({
                ordering : true,
                  order: [[ 0, "asc" ]],
                      serverSide: true,
                      processing: true,
                      ajax: {
                            url:'/gettodolist',
                            type: 'GET',
                        },
                      columns: [
                          {data: 'id',"width": "18%"},
                          {data: 'title',"width": "18%"},
                          {data: 'userId',"width": "12%"}, 
                          {data: 'completed',"width": "18%","render": function (data) {
                            return (data==1)?"<font style=\"color:#006d34\">Completed</font>":"<font style=\"color:#FF0000\">Not completed</font>";
                            }
                          },			                
                  
                      ]
      });
      //console.log(table.cells());
    });
  </script>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('To Do List') }}
                  
                </div>

                {{-- Messge  --}}
                <div>
                  @if(session('response'))
                    <span style="color: green;font-weight:100;" class="px-4">  {{ session('response') }} </span>
                  @endif
                </div>

                <div class="px-4 py-4">

                  <table id="to-do-list-table" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>User Id</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                  </table>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
