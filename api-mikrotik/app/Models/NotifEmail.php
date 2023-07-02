<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifEmail extends Model
{
    use HasFactory;
    protected $table = 'notif_email';
    protected $fillable = [
        'id',
        'id_adm',
        'akun_email',
        'jam',
        'menit',
        'time_lock',
    ];
}
