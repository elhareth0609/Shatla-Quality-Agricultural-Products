<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPermission extends Model
{
    use HasFactory;

    protected $fillable = [
    'permission_id',
    'plan_id'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
