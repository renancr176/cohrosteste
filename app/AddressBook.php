<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name', 
        'email', 
        'zip_code', 
        'address', 
        'number', 
        'complement', 
        'district', 
        'city',
        'state'
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'created_at'
    ];
    
    public static $rules = [
        'name' => 'required|max:191',
        'email' => 'email|max:191',
        'zip_code' => 'min:9|max:9',
        'address' => 'max:191',
        'number' => 'numeric',
        'district' => 'max:191',
        'city' => 'max:191',
        'state' => 'max:2'
    ];


    public function User()
    {
        return $this->belongsTo('App\User', 'id');
    }
    
    public function PhoneNumbers()
    {
        return $this->hasMany('App\PhoneNumber', 'address_book_id');
    }
}
