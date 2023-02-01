<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialPageClick extends Model
{
    use HasFactory;

    public $fillable = [
        'special_page_id',
        'number',
        'is_win',
        'profit'
    ];
}
