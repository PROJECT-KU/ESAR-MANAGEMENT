<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UsesUuid;
use Carbon\Carbon;

class TrainingsPendaftarans extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'trainings_id',
        'id_transaksi',
        'name',
        'telp',
        'email',
        'biaya',
        'kode_unik_biaya',
        'biaya_diskon',
        'total_biaya',
        'metode_pembayaran',
        'lokasi',
        'status',
        'foto',
    ];

    // Specify table if it does not follow Laravel's naming convention
    protected $table = 'trainings_pendaftarans';

    // Optionally specify primary key if it's not 'id'
    protected $primaryKey = 'id';
}
