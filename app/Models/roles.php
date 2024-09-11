<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = ['name','admin_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
