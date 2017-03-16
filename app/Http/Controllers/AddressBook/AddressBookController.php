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
use App\Http\Requests\AddressBookRequest;

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
     * @param  int  $qtd
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AddressBooks = AddressBook::where('user_id', Auth::user()->id)->orderBy('name')->paginate(10);
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
    public function store(AddressBookRequest $request)
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
        return view('address_book.show', compact('AddressBook','PhoneTypes'));
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
        $PhoneTypes = PhoneType::all();
        return view('address_book.edit', compact('AddressBook','PhoneTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressBookRequest $request, $id)
    {
        $AddressBook = AddressBook::where('user_id', Auth::user()->id)->findOrFail($id);
        DB::beginTransaction();
        try {
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
            
            /**
             * Delete Phone Numbers
             */
            $PhoneNumbers = PhoneNumber::where('address_book_id', $AddressBook->id)->get();
            foreach($PhoneNumbers as $PhoneNumber){
                if(!in_array($PhoneNumber->id, $request->get('phone_id'))){
                    $PhoneNumber->delete();
                }
            }
            
            /**
             * Update or Create Phone Numbers
             */
            foreach($this->joinPhoneData($request->get('phone_type'), $request->get('phone'), $request->get('phone_id')) as $k => $PhoneData){
                $PhoneNumber = PhoneNumber::where('address_book_id', $AddressBook->id)->find($PhoneData['phoneID']);
                if(!is_null($PhoneNumber)){
                    $PhoneNumber->phone_type_id = $PhoneData['phoneType'];
                    $PhoneNumber->phone = $PhoneData['phoneNumber'];
                    $PhoneNumber->save();
                }else{
                    $PhoneNumber = PhoneNumber::create([
                        'address_book_id' => $AddressBook->id,
                        'phone_type_id' => $PhoneData['phoneType'],
                        'phone' => $PhoneData['phoneNumber']
                    ]);
                }
            }
            
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
      
        DB::commit();
        return redirect()->route('contact.show', ['id' => $id])->with('AlertSuccess', '<p>Contato Atualizado com sucesso!</p>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $AddressBook = AddressBook::where('user_id', Auth::user()->id)->findOrFail($id);
        DB::beginTransaction();
        try {
            foreach($AddressBook->PhoneNumbers as $PhoneNumber){
                $PhoneNumber->delete();
            }
            $AddressBook->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->withInput();
        }
      
        DB::commit();
        return redirect('contact')->with('AlertSuccess', '<p>Contato Excluido com sucesso!</p>');
    }
    
    public function joinPhoneData($PhoneTypes, $PhoneNumbers, $PhoneID = array()){
        $Join = array();
        foreach($PhoneTypes as $k=>$PhoneType){
            $Join[$k] = array(
                                'phoneID' => ((array_key_exists($k, $PhoneID) && !empty($PhoneID[$k]))? $PhoneID[$k]:0), 
                                'phoneType' => $PhoneType, 
                                'phoneNumber' => $PhoneNumbers[$k]
                            );
        }
        return $Join;
    }
}
