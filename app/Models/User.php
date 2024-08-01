<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use AshAllenDesign\ShortURL\Models\ShortURL;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

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

    function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        // If the panel ID is 'admin' and the user is an admin, return true
        // If the panel ID is 'user' and the user is not an admin, return true
        // Otherwise, return false
        return ($panelId === 'admin' && $this->is_admin) || ($panelId === 'user' && !$this->is_admin);
    }

    //add has many short_urls relationship
    public function short_urls()
    {
        return $this->hasMany(ShortURL::class);
    }
}
