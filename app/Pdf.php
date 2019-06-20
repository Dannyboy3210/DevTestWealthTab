<?php
// Text taken from: https://appdividend.com/2018/08/15/laravel-file-upload-example/#3_Create_a_View_and_Route_for_uploading_files
// and adapted to work here
// PDF.php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pdf extends Model
{
    public $timestamps=true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_id', 'pdf_name' //'pdf' is being removed  //'password' is Being replaced with a user-pdf permissions table
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token' //'password' is Being replaced with a user-pdf permissions table
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'uploaded_at' => 'datetime',
    ];

	public function user()
	{
	   return $this->belongsTo(User::class,'creator_id');
    }
    
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}