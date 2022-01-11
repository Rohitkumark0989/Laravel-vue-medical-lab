<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\Test;
use PDF;
use Response;
use File;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
//use App\Exports\PatientExport;
//use Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Excel as ExcelType; 
use DateTime;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index($from,$to,$search = null)
    {   
         
        $data = Patient::whereBetween('created_at', [$from, $to])
        ->where(function ($query) use ($search) {
            $query->where('p_name', 'like', '%' . $search . '%');
          })
        ->orderBy('id','DESC')->get();
        //$data = Patient::orderBy('id','DESC')->get();
        return response(['data' =>$data, 'status' => 200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data['p_name'] = $request->input('name');
        $data['p_mobile'] = $request->input('mobile');
        $data['p_age'] = $request->input('age');
        $data['p_gender'] = $request->input('gender');
        $data['p_cnic'] = $request->input('cnic');
        $data['p_address'] = $request->input('address');
        $amounts = $request->input('amounts');
        $data['p_subtotal'] = $amounts[0]['subtotal'];
        $data['p_discount'] = $amounts[0]['discount'];
        $data['p_total'] = $amounts[0]['total'];;
        $adminEmail = userData()['email'];
        $patientData = Patient::create($data);
        
        foreach($request->input('labs') as $item){
            $testData['patient_id'] = $patientData->id;    
            $testData['test_id'] = $item['id'];
            PatientTest::create($testData);    
        }

        $data = [
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'cnic' => $request->input('cnic'),
            'address' => $request->input('address'),
            'subtotal' => $amounts[0]['subtotal'],
            'discount' => $amounts[0]['discount'],
            'total' => $amounts[0]['total'],
            'tests' => $request->input('labs'),
            'date' => date('m/d/Y')
        ];
       
        
        //$pdf = PDF::loadView('testPDFOLD', $data);        
        $pdf = PDF::loadView('testPDF', $data);        
        \Storage::put('/public/pdf/tests.pdf', $pdf->output());  

         $filename = '/app/public/pdf/tests.pdf';
         $path = storage_path($filename);
        
         // Email Functionalilty
        $details = [
            'data' => $data,
            'title' => 'Test Details',
            'message' => 'Below is the detail mentioned for your Interveiw date and time.',
            'password' => '',
            'attachement' => $path,
            'link' => request()->getHost()
        ];

        Mail::send('emails.TestMail',["details"=>$details], function($message) use ($details,$path,$adminEmail){
            $message->to($adminEmail,'Test Details')->subject('Patient Test Details');
            $message->from('info@estimate.com','We Provide Authenticate Lab Tests Service');
            $message->attach($path);

        });

        return Response::make(file_get_contents($path), 201, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);

        //return response(['success' => 201]);  
        //return response(['success' => 201],[$pdf->download('tutsmake.pdf')]); 
    }

    // Download Excel Function
    public function downloadExcelOLD(Request $request){
        $search = $request->input('name');
        $to = $request->input('to');
        $from = $request->input('from');
        $data = $this->index($from,$to,$search);
        $result = json_decode(json_encode($data), true);
        $result = $result['original']['data'];
        $customer_data = $result;
     $customer_array[] = array('Date','Name', 'Mobile', 'Gender', 'Age', 'Address');
     foreach($customer_data as $customer)
     {
      $customer_array[] = array(
       'Date'  => $customer['created_at'],
       'Name'  => $customer['p_name'],
       'Mobile'   => $customer['p_mobile'],
       'Gender'    => $customer['p_gender'],
       'Age'  => $customer['p_age'],
       'Address'   => $customer['p_address']
      );
     }
     Excel::download('Customer Data', function($excel) use ($customer_array){
      $excel->setTitle('Customer Data');
      $excel->sheet('Customer Data', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');
        
    } 

    public function downloadExcel(Request $request){
        $search = $request->input('name');
        $to = $request->input('to');
        $from = $request->input('from');
        $data = $this->index($from,$to,$search);
        $result = json_decode(json_encode($data), true);
        $result = $result['original']['data'];
        $reArrange = [];
        $testList = [];
        $testPrice = [];
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        foreach($result as $val){
            $testData = Patient::find($val['id'])->testDetails;
            $allTestRecord = json_decode(json_encode($testData), true);
             for($i=0;$i<count($allTestRecord);$i++){
                 if($allTestRecord[$i]['pivot']['patient_id'] == $val['id']){
                     $testList[$val['id']][] = $allTestRecord[$i]['t_name'];
                     $testPrice[$val['id']][] = $allTestRecord[$i]['t_price'];
                 }
                 
            }    
            //echo "<pre>";print_r(end($testList));echo "</pre>";
                        
            $dt = new DateTime($val['created_at']);
            $reArrange[] = [
                'created_at' =>$dt->format('d-M-Y'),
                'p_name' => $val['p_name'],
                'p_age' => $val['p_age'],
                'p_gender' => $val['p_gender'],
                'p_mobile' => $val['p_mobile'],
                'p_cnic' => $val['p_cnic'],
                'p_address' => $val['p_address'],
                'tests' => end($testList),
                'price' => end($testPrice),
                'p_subtotal' => $val['p_subtotal'],
                'p_discount' => $val['p_discount'],
                'p_total' => $val['p_total'],
            ];
            $subtotal +=$val['p_subtotal'];
            $discount +=$val['p_discount'];
            $total +=$val['p_total'];
        }
        $grand[] = ['','','','','','','','','','Grand Sub Total' =>$subtotal,'Grand Discount' => $discount, 'Grand Total' => $total];
        
        $result = $reArrange;
        $user_array[] = ['Date','Name','Age','Gender','Mobile','CNIC','Address','Tests','Price','Subtotal','Discount','Total'];
        
             
             for($i=0;$i< count($result);$i++){
                 $answer_array[] = $result[$i]; 
             }
             
             $user_array[] = $answer_array;
        
            //  $time = date('-h-i-s');
            //  $xlxname='rohit_'.date('m-d-Y'.$time).'.xlsx';
    
             $filename = '/app/public/uploads/release/';
             $path = storage_path($filename);
             $array = array_merge($user_array,$grand);
 

              \Excel::store(new class($array) implements FromArray{ 
                 public function __construct($array)
                 {
                     $this->array = $array;
                     
                 }
                 public function array(): array
                 {
                     return $this->array;
                 }
             },'public/uploads/release/all-test-list.xlsx');  
 
            return response(['status'=>200]);

 
}
    public function testPdf(){
        $data = [
            'title' => 'Welcome to Tutsmake.com',
            'date' => date('m/d/Y')
        ];
        
        //$pdf = PDF::loadView('testPDF', $data);
        $pdf = PDF::loadView('testPDF', $data);
        

        \Storage::put('/pdf/invoice44.pdf', $pdf->output());  

       return $pdf->download('tutsmake.pdf');
    }

    public function getTotalCount(){
        $subTotal = Patient::sum('p_subtotal');
        $discount = Patient::sum('p_discount');
        $total = Patient::sum('p_total');
        return response(['status'=>200,'subtotal' => (int)$subTotal,'discount' => (int)$discount,'total' => (int)$total]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patientData = Patient::find($id);
        $testData = Patient::find($id)->testDetails;
        return  response(['status' => 200,'patientData' =>$patientData,'testData' => $testData]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
