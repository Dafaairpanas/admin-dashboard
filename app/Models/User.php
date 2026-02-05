<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function refRoleUser()
    {
        return $this->hasOne(RoleUser::class, 'user_id', 'id');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    // }

    // Accessor removed to prevent shadowing legacy 'role' column
    public function getRefRoleAttribute()
    {
        return $this->refRoleUser()->first();
    }

    public function getRoleColorAttribute()
    {
        // 1. Try relationship
        $role = $this->refRoleUser->first();
        if ($role && $role->badge_color) {
            // Map standard bootstrap names if stored in DB
            $colors = [
                'success' => '#198754',
                'info' => '#0dcaf0',
                'warning' => '#ffc107',
                'danger' => '#dc3545',
                'primary' => '#0d6efd',
                'secondary' => '#6c757d',
            ];
            if (isset($colors[$role->badge_color])) {
                return $colors[$role->badge_color];
            }
            return $role->badge_color;
        }

        // 2. Fallback to legacy
        $colors = [
            'admin' => '#0dcaf0',
            'superadmin' => '#198754',
            'manager' => '#ffc107',
        ];

        // Since role column is removed, we default to grey if no role relation found
        return '#6c757d';
    }

    /**
     * Check if user has a specific role
     * @param string $roleName
     * @return bool
     */
    public function hasRole($roleName)
    {
        return $this->refRoleUser()->where('role_id', $roleName)->exists();
    }

}
