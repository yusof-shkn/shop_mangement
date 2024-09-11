<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $fillable = ['admin_id','category','amount'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
