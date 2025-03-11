<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
    ];

    /**
     * Get the user that owns the contact information.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
