<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SearchProfile extends Model
{
    use HasFactory;

    protected $casts = [
        'search_fields' => 'array',
    ];

    protected $fillable = ['name', 'property_type_id', 'search_fields'];

    /** Relationships */
    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
}
