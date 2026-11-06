<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $connection = 'mysql'; // second DB connection
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'temp_password',
        'profile_pic',
        'user_group_id',
        'inventory_id',
        'is_customer',
        'is_profile_complete',
        'is_social',
        'is_active',
        'is_pos_customer',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'temp_password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $appends = ['profile_pic_url'];

    public function getProfilePicUrlAttribute()
    {
        $defaultImage = 'assets/img/user/default.png';

        if (!empty($this->profile_pic)) {
            return asset($this->profile_pic);
        }
        return asset($defaultImage);
    }

    /**
     * Override the can() method to allow super_admin to bypass all checks.
     *
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function can($ability, $arguments = []): bool
    {
        // If user has super_admin role, grant all permissions
        if ($this->hasRole('super_admin')) {
            return true;
        }

        return parent::can($ability, $arguments);
    }

    public function customerDetail()
    {
        return $this->hasOne(CustomerDetail::class, 'user_id', 'id');
    }

    public function inventoryTypeDetail()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_id');
    }

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first();
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class, 'user_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function getOrderSummationAttribute()
    {
        $totalOrderCount = 0;
        $totalOrderPaidAmount = 0;

        foreach($this->orderDetails as $order){
            $totalOrderCount++;
            $totalOrderPaidAmount += $order->paid_amount;
        }

        return [
            'orders_count' => $totalOrderCount ?? 0,
            'orders_amount' => $totalOrderPaidAmount ?? 0.00
        ];
    }
}
