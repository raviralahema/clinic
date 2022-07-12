<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\DataTables\PatientDataTable;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   // public function index(PatientDataTable $dataTable)
    public function index()
    {
		
		//return $dataTable->render('patient');
        //
		$patients = Patient::paginate(2);
		return view('patient',['patients'=>$patients,'layout'=>'index'], compact('patients'));
    }
	

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$patients = Patient::all();
		return view('patient',['patients'=>$patients,'layout'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$student = new Patient();
		$student->patient_name = $request->input('patient_name');
		$student-> description = $request->input('desc');
		$student->dob = $request->input('dob');
		$student->gender = $request->input('gender');
		$student->Insurance_number = $request->input('insurance_number');
		$student->clinic_id = $request->input('clinic_id');
		$student->admission_date = $request->input('admission_date');
		$student->discharge_date = $request->input('discharge_date');

		$student->save();
		return redirect('/create')->with('message', 'Successfully inserted');

		//return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
		$patients = patient::all();
		return view('patient',['patients'=>$patients,'patient'=>$patient,'layout'=>'show']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = patient::find($id);
		$patients = patient::all();
		return view('patient',['patients'=>$patients,'patient'=>$patient,'layout'=>'edit']);
    }
	
	public function view($id)
    {
        $patient = patient::find($id);
		$patients = patient::all();
		return view('patient',['patients'=>$patients,'patient'=>$patient,'layout'=>'view']);
    }
	
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Patient::find($id);
		$student->patient_name = $request->input('patient_name');
		$student->description = $request->input('desc');
		$student->dob = $request->input('dob');
		$student->gender = $request->input('gender');
		$student->Insurance_number = $request->input('insurance_number');
		$student->clinic_id = $request->input('clinic_id');
		$student->admission_date = $request->input('admission_date');
		$student->discharge_date = $request->input('discharge_date');

		$student->save();
		return redirect('/edit/'.$id)->with('message', 'Successfully updated');

		//return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Patient::find($id);
		$student->delete();
		return redirect('/');
    }
	
	public function search_datatable(PatientDataTable $dataTable)
	{
		return $dataTable->render('patientlist_datatable');
	}
	
	public function search_datatable_column(PatientDataTable $dataTable)
	{
		$patient      =       Patient::all();
       // return view("search_columnwise", compact("patient"));
				return view('search_columnwise',['patients'=>$patient], compact('patient'));

	}
	
	public function search(Request $request)
	{
		if($request->ajax())
		{
			$output="";
			$patients=Patient::query()->where('clinic_id','LIKE','%'.$request->searchh."%")->paginate(2);
			
					//return view('patientsearch',['patients'=>$patients], compact('patients'));
					      return view('patientsearch', compact('patients'))->render();


		/*	if($products)
			{
				foreach ($products as $key => $product) {
				$output.='<tr>'.
				'<td>'.$product->Patient_Name.'</td>'.
				'<td>'.$product->description.'</td>'.
				'<td>'.$product->dob.'</td>'.
				//'<td>'.$product->gender.'</td>'.
				//'<td>'.$product->Insurance_number.'</td>'.
				'<td>'.$product->clinic_id.'</td>'.
				'<td>'.$product->admission_date.'</td>'.
				'<td>'.$product->discharge_date.'</td>'.
				'</tr>';
				'<tr><td>'.$products->render().'</td></tr>';
				}
				return Response($output);
				    //return response($output)->json(array('success' => true, 'html'=>$pagew));

			} */  
		}
	}
	public function search_date(Request $request)
	{
		if($request->ajax())
		{
			$output="";
			//echo 'admission_date',' between ',"'".$request->admission_date1."'",' and ',"'".$request->admission_date2."'"; //exit;
		//$query = \DB::table('Patient')->where('admission_date',' between ',"'".$request->admission_date1."'",' and ',"'".$request->admission_date2."'");
		// Str::replaceArray('?', $query->getBindings(), $query->toSql());
		//$products=Patient::query()->where('admission_date',' wherebetween ',"'".$request->admission_date1."'",' and ',"'".$request->admission_date2."'" )->get();
		//dump($products);
		if($request->admission_date1 != '' && $request->admission_date2 != '')
		{
			$patients = Patient::query()
			->whereBetween('admission_date', array($request->admission_date1, $request->admission_date2))
			
			->paginate(2);
		}
		else
		{
			$patients = Patient::query()->orderBy('admission_date', 'desc')->paginate(2);
		}
		
			return view('patientsearch', compact('patients'))->render();

		/*if($products)
		{
			foreach ($products as $key => $product) {
			$output.='<tr>'.
			'<td>'.$product->Patient_Name.'</td>'.
			'<td>'.$product->description.'</td>'.
			'<td>'.$product->dob.'</td>'.
			//'<td>'.$product->gender.'</td>'.
			//'<td>'.$product->Insurance_number.'</td>'.
			'<td>'.$product->clinic_id.'</td>'.
			'<td>'.$product->admission_date.'</td>'.
			'<td>'.$product->discharge_date.'</td>'.
			'</tr>';
			}
			return Response($output);
		} */
		}
	}
	
	
}
