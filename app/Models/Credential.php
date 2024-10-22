<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Credential extends Model
{
    use HasFactory, HasUlids;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
        'value',
        'user_id'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'type' => 'array',
        'value' => 'encrypted'
    ];

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function checks(): HasMany
    {
        return $this->hasMany(Check::class, 'service_id');
    }
}
