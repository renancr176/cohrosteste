<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_book_id', 
        'phone_type_id', 
        'phone'
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function AddressBook()
    {
        $this->belongsTo('App\AddressBook');
    }
    
    public function PhoneType(){
        return $this->belongsTo('App\PhoneType');
    }
}
