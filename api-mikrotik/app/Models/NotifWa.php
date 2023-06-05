<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifWa extends Model
{
    use HasFactory;
    protected $table = 'notif_wa';
    protected $fillable = [
        'id',
        'id_adm',
        'no_wa',
        'no_twilio',
        'account_sid',
        'auth_token',
        'jam',
        'menit',
        'detik',
    ];
}
