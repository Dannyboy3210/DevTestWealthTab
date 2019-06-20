<?php
// Text taken from: https://appdividend.com/2018/08/15/laravel-file-upload-example/#3_Create_a_View_and_Route_for_uploading_files
// and adapted to work here
// PDF.php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    public $timestamps=true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pdf_id', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    public function pdf()
	{
	   return $this->belongsTo(PDF::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
