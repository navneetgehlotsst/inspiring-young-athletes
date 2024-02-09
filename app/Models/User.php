<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'category',
        'user_status',
        'quetion_status',
        'profile',
        'phone',
        'referral_token',
        'referral_by',
        'linkdin',
        'tiktok',
        'instagram',
        'facebook',
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id')->where('video_status','1')->take(10);
    }


    public function TopVideoList()
    {
        return $this->hasMany(Video::class, 'user_id')->where('video_status','1')->orderBy('Video_veiw_count', 'desc');
    }

    public function videosTotalCount()
    {
        return $this->hasMany(Video::class, 'user_id')->where('video_status','1');
    }
}
