<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRequestTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_request_id',
        'title',
        'description',
        'status',
        'created_by',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the product request that owns the timeline entry
     */
    public function productRequest(): BelongsTo
    {
        return $this->belongsTo(ProductRequest::class);
    }

    /**
     * Get the user who created this timeline entry
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
