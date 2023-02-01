<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 *
 * @package App\Models
 *
 * @property string $username
 * @property string $phone
 * @property SpecialPage[] $specialPage
 */

class Client extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var string[]
     */
    public $fillable = [
        'username',
        'phone'
    ];

    /**
     * @return HasMany
     */
    public function specialPage(): HasMany
    {
        return $this->hasMany(SpecialPage::class);
    }
}
