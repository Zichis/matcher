<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Property extends Model
{
    use HasFactory;

    protected $casts = [
        'fields' => 'array'
    ];

    protected $fillable = ['name', 'address', 'property_type_id', 'fields'];

    /** Relationships */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
}
