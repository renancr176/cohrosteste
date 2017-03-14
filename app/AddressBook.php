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


    public function User()
    {
        return $this->belongsTo('App\User', 'id');
    }
    
    public function PhoneNumbers()
    {
        return $this->hasMany('App\PhoneNumber', 'address_book_id');
    }
}
