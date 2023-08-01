<?php

namespace App\Models;

use App\Mail\AdminMail;
use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile',
        'phone',
        'email',
        'gender',
        'dob',
        'has_organization',
        'username',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function organization()
    {
        # code...
        return $this->hasOne(Organization::class);
    }

    public function sendMail($email, $password)
    {
        $login = route('admin.login');
        $details = [
            'email' => $email,
            'password' => $password,
            'login' => $login
        ];
        try {
            Mail::to($email)->send(new AdminMail($details));
            info("Email successfully sent");
        } catch (Exception $e) {
            info("Error: " . $e->getMessage());
        }
    }
}
