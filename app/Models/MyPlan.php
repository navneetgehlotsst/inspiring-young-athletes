<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MyPlan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'my_plan';

    protected $fillable = [
        'business_id',
        'plan_id',
        'plan',
        'amount',
        'total_offer',
        'remaining_offer',
        'expiry_date',
        'charge_token',
        'status',
    ];
	
	public function offer()
    {
        return $this->hasMany(Offers::class,'plan_id','id');
    }

    public function planList()
    {
        return $this->belongsTo(Plan::class,'plan_id','id');
    }

}
