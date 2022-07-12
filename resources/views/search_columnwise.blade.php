<!doctype html>
<html lang="en">
  <head>
    <title>Datatable Column Filter | Laravel 6 | Programming Fields</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <style>
        thead input {
           width: 100%;
        }
    </style>
  </head>
  <body>
    <div class="container=fluid p-3">
        <h4 class="text-center"> Datatable Column Filter </h4>
        <table class="table table-bordered" id="mytable">
			<thead>
				<tr>
					<th scope="col">Patient Name</th>
					<th scope="col">Description</th>
					<th scope="col">DOB</th>
					<th scope="col">Gender</th>
					<th scope="col">Insurance Number</th>
					<th scope="col">Clinic ID</th> 
					<th scope="col">Admission Date</th>
					<th scope="col">Discharge Date</th> 
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
    <tbody>
  @foreach($patients as $student)
    <tr>
		
		<td>{{ $student->Patient_Name }}</td>
		<td>{{ $student->description }}</td>
		<td>{{ $student->dob }}</td>
		<td>{{ $student->gender }}</td>
		<td>{{ $student->Insurance_number }}</td>
		<td>{{ $student->clinic_id }}</td>
		<td>{{ $student->admission_date }}</td>
		<td>{{ $student->discharge_date }}</td>


		<td>
		<a href="{{ url('/edit/'.$student->id)}}" class="btn btn-sm btn-info" target="_blank">Edit</a>
		</td>
		<td>
		<a href="{{ url('/show/'.$student->id)}}" class="btn btn-sm btn-info" target="_blank">View</a>
		</td>
		<td><a href="{{ route('delete_category', $student->id) }}" onclick="return confirm('Are you sure you want to delete this patient?')" class="btn btn-info">Delete</a>
		</td>				

    </tr>
    @endforeach
  </tbody>
        </table>

    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#mytable thead tr').clone(true).appendTo( '#mytable thead' );
            $('#mytable thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder=" Search '+title+'" />' );

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                });
            });

            var table = $('#mytable').DataTable( {
                orderCellsTop: true,
                fixedHeader: true
            });
        });
    </script>
  </body>
</html>