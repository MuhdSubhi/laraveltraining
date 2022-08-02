<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use App\Mail\StaffCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //variable = new (nama model)
        // $staff = new Staff;
 
        //variable->name dari skrin = $request->name column database
        // $staff->fname = $request->fname;
        // $staff->lname = $request->lname;
 
        // $staff->save();

        // Log::debug('unsuccessful');
        
        request()->validate([
            'fname' => 'required|max:10',
            'lname' => 'required'
        ]);

        // Log::debug("message",['successful']);

        // Staff::create(request()->all());
        // dd($request->all());
        
        $staff = new Staff;
        $staff->fill(request()->all());
        $staff->user_id = auth()->user()->id;
        $staff->save();

        return redirect()->route('form.show');
    }

    public function show() {
        // Log::debug('stafflist');
        $staffs = Staff::with('users')->orderBy('created_at','asc')->paginate(5);
        $currency = $this->getFromAPI();

        // Log::debug('stafflist', [$staffs]);
        return view ('utama' , [ 'staffs' => $staffs, 'currency'=> $currency->data]); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::destroy($id);
        return redirect()->route('form.show');
    }

    public function edit($id)
    {
        $staff = Staff::find($id);

        return view('form.edit' , compact('staff'));
    }

    public function update($id)
    {
        $staff = Staff::find($id);

        $staff ->fill(request()->all());
        $staff->save();

        Mail::to('subhiips@gmail.com')->send(new StaffCreated());

        return redirect()->route('form.show');
    }

    public function getHttpHeaders(){
        $headers= [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.BNM.API.v1+json'
            ],
            'http_errors' => false,
        ];
        return $headers;
    }

    public function getFromAPI(){
        $client = new \GuzzleHttp\Client(self::getHttpHeaders());

        $res = $client->request('GET', 'https://api.bnm.gov.my/public/exchange-rate');

        $currencyResponse = $res->getBody()->getContents();

        return json_decode($currencyResponse);
    }

    
}
