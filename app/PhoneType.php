<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'created_at'
    ];
    
    public static $rules = [
        'name' => 'required|alpha|max:191'
    ];
    
    public function PhoneNumbers()
    {
        return $this->hasMany('App\PhoneNumber');
    }
}
