<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'position_id',
        'first_name',
        'middle_name',
        'surname',
        'address',
        'email',
        'phone_number',
        'attachment',
    ];

    /**
     * Define the relationship with the Position model.
     */
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
