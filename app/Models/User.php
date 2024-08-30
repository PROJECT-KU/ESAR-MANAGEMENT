<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UsesUuid;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'alamat',
        'telp',
        'email_verified_at',
        'code_verified_mail',
        'password',
        'role',
        'status',
        'foto',
        'last_activity',
        'remember_token',
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

    /**
     * Get the user's last active time.
     *
     * @return string
     */
    public function lastActive()
    {
        // Check if the last_activity is set
        if (!$this->last_activity) {
            return 'Tidak Pernah Terlihat';
        }

        $lastSeen = Carbon::parse($this->last_activity);
        $now = Carbon::now();
        $daysSinceLastActivity = $lastSeen->diffInDays($now);
        $hoursSinceLastActivity = $lastSeen->diffInHours($now);
        $minutesSinceLastActivity = $lastSeen->diffInMinutes($now);

        // If the user is currently online (last activity within the last 5 minutes)
        if ($minutesSinceLastActivity <= 5) {
            return 'Pengguna Sedang Online';
        }

        // If the last activity was within the last 24 hours
        if ($hoursSinceLastActivity < 24) {
            // Return hours and minutes if less than 24 hours
            if ($hoursSinceLastActivity > 0) {
                return "$hoursSinceLastActivity jam yang lalu";
            } else {
                return "$minutesSinceLastActivity menit yang lalu";
            }
        }

        // Otherwise, return how many days ago
        return $daysSinceLastActivity . ' hari yang lalu';
    }
}
