<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public static function addOrUpdate($userId,$name,$email,$role)
    {
        $user = $userId ? User::find($userId) : new User();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = bcrypt('12345678');
        $user->save();
    }

    public static function getUser($role)
    {
        return User::where('role',$role)->get();
    }

    public static function deleteUser($id)
    {
        User::where('id',$id)->delete();
    }
}
