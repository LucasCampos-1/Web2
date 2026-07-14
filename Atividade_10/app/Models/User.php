<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
 {
    use HasFactory, Notifiable;

        protected $fillable = [
        'name', 'email', 'password', 'role', 'debit',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isBibliotecario(): bool
    {
        return $this->role === 'biblioteca';
    }

    public function isCliente(): bool
    {
        return $this->role === 'cliente';
    }

    protected function casts()
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'debit' => 'decimal:2',
        ];
    }

    public function hasDebt(): bool
    {
        return $this->debit > 0;
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
                    ->withPivot('id', 'borrowed_at', 'returned_at')
                    ->withTimestamps();
    }
}
