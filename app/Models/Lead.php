<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'product_interest',
        'score',
        'status',
    ];

    protected $attributes = [
        'score' => 0,
        'status' => 'New',
    ];

    public const STATUS_NEW = 'New';
    public const STATUS_PROCESSING = 'Processing';
    public const STATUS_CLOSED = 'Closed';
    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-primary-subtle text-primary',
            self::STATUS_PROCESSING => 'bg-warning-subtle text-warning',
            self::STATUS_CLOSED => 'bg-success-subtle text-success',
            default => 'bg-secondary-subtle text-secondary',
        };
    }
}
