<table class="table">
  <thead class="thead-light">
   
  </thead>
  <tbody>
  @foreach($patients as $student)
    <tr>
		
		<td>{{ $student->Patient_Name }}</td>
		<td>{{ $student->description }}</td>
		<td>{{ $student->dob }}</td>
		<!--<td>{{ $student->gender }}</td>
		<td>{{ $student->Insurance_number }}</td>-->
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
{!! $patients->render() !!}