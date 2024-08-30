<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UsesUuid;
use Carbon\Carbon;

class Trainings extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tanggal_mulai',
        'tanggal_akhir',
        'biaya',
        'name_diskon',
        'biaya_diskon',
        'lokasi',
        'deskripsi',
        'status',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
}
