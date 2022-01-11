<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Test;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $data = Test::where("status",'1')->orderBy('t_name')->get();
        
        return response($data, 200);
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
        $data['t_name'] = $request->input('testName');
        $data['t_price'] = $request->input('testPrice');
        $testData = Test::create($data);
        if($testData){
            return response(['status' => 201]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $testData = Test::find($id);
        
        return  response(['status' => 200,'testData' =>$testData]); 
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
        $testName = $request->input('testName');
        $testPrice = $request->input('testPrice');
        $testDetail = Test::find($id);
        if ( $testDetail ){
            $testDetail->t_name = $testName;
            $testDetail->t_price = $testPrice;
            $testDetail->save();
            return response(['status' => 201]);
        }
    }

    public function getTestCount(){

        $totalTest = Test::where('status', '=', '1')->get();
        $totalTest = $totalTest->count();
        return response(['status'=>200,'totalTest' => $totalTest]);
    }
    public function softDelete(Request $request, $id){
        
        $testDetail = Test::find($id);
        if ( $testDetail ){
            $testDetail->status = '0';
            $testDetail->save();
            return response(['status' => 201]);
        }
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
