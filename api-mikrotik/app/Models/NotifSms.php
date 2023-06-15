<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifSms extends Model
{
    use HasFactory;
    protected $table = 'notif_sms';
    protected $fillable = [
        'id',
        'id_adm',
        'no_sms',
        'no_twilio',
        'account_sid',
        'auth_token',
        'jam',
        'menit',
        'detik',
    ];
}
