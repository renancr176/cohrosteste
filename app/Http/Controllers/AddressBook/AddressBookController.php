<?php

namespace App\Http\Controllers\AddressBook;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use DB;
use App\AddressBook;
use App\PhoneNumber;
use App\PhoneType;

class AddressBookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AddressBooks = AddressBook::where('user_id', Auth::user()->id)->get();      
        
        return view('address_book.index', compact('AddressBooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $PhoneTypes = PhoneType::all();
        return view('address_book.create', compact('PhoneTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $AddressBook = AddressBook::create([
                'user_id' => Auth::user()->id,
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'zip_code' => $request->get('zip_code'),
                'address' => $request->get('address'),
                'number' => $request->get('number'),
                'complement' => $request->get('complement'),
                'district' => $request->get('district'),
                'city' => $request->get('city'),
                'state' => $request->get('state')
            ]);

            foreach($this->joinPhoneData($request->get('phone_type'), $request->get('phone')) as $k => $PhoneData){
                $PhoneNumber = PhoneNumber::create([
                    'address_book_id' => $AddressBook->id,
                    'phone_type_id' => $PhoneData['phoneType'],
                    'phone' => $PhoneData['phoneNumber']
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
      
        DB::commit();
        return redirect('contact')->with('AlertSuccess', '<p>Contato Craiado com sucesso!</p>');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $AddressBook = AddressBook::with('PhoneNumbers')->where('user_id', Auth::user()->id)->findOrFail($id);
        return view('address_book.show', compact('AddressBook','PhoneType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AddressBook = AddressBook::with('PhoneNumbers')->where('user_id', Auth::user()->id)->findOrFail($id);
        return view('address_book.edit');
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
        $AddressBook = AddressBook::findOrFail($id);
        
        $AddressBook->name = $request->get('name');
        $AddressBook->email = $request->get('email');
        $AddressBook->zip_code = $request->get('zip_code');
        $AddressBook->address = $request->get('address');
        $AddressBook->number = $request->get('number');
        $AddressBook->complement = $request->get('complement');
        $AddressBook->district = $request->get('district');
        $AddressBook->city = $request->get('city');
        $AddressBook->state = $request->get('state');
        
        $AddressBook->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $AddressBook = AddressBook::findOrFail($id);
        $AddressBook->delete();
    }
    
    public function joinPhoneData($PhoneTypes, $PhoneNumbers){
        $Join = array();
        foreach($PhoneTypes as $k=>$PhoneType){
            $Join[] = array('phoneType' => $PhoneType, 'phoneNumber' => $PhoneNumbers[$k]);
        }
        return $Join;
    }
}
