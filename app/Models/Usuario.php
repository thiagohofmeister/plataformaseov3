<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\CanResetPassword;

//use Illuminate\Auth\Passwords\CanResetPassword;

class Usuario extends Authenticatable {

    protected $fillable = [
        'imagem',
        'nome',
        'email',
        'genero',
        'facebook',
        'googleplus',
        'twitter',
        'password',
        'id_cargo'
    ];
    public $timestamps = false;

    public function setDatas() {
        if (!empty($this->password)) {
            $this->password = Hash::make($this->password);
        }
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }

}
