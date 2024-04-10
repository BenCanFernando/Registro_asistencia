<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAudit extends Model
{
    use HasFactory;
    public $table= 'users_audit';
    public $fillable =[
    	'user_id',
        'action',
        'action_timestamp'
    ];
    public function usuarios (){
        return $this->belongsToMany(User::class,'id');
    }
}