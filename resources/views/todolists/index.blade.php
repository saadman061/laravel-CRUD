@extends('layouts.app')
@section('title', 'View All To Do List')

@section('customJavascript')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
 
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    
    $('#to-do-list-table').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'excel',
          'csv'
      ],
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
    
  });
  </script>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('To Do List') }}</div>

                
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
