<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function pdfs()
	{
		return $this->hasMany(PDF::class,'creator_id');
	}	
	
	public function uploads()
	{
	   return $this->hasMany(Upload::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Test if user has access to pdf (is owner or has permission)
     * 
     * @param Pdf
     */
    public function hasAccess($pdf)
    {
        $pdfList = $this->pdfs;
        return in_array($pdf,$pdfList->toArray()) || $this->id == $pdf->creator_id;
    }
}
