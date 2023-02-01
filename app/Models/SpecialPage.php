<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Guid\Guid;

/**
 * Class SpecialPage
 *
 * @package App\Models
 *
 * @property int $client_id
 * @property string $hash
 * @property Carbon $created_at
 *
 * @property Client $client
 */
class SpecialPage extends Model
{
    const LIFETIME_DAYS = 7;

    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = [
        'client_id',
        'hash'
    ];

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return HasMany
     */
    public function specialPageClicks(): HasMany
    {
        return $this->hasMany(SpecialPageClick::class);
    }
}
