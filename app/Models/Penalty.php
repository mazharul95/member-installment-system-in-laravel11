<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penalty extends Model
{
    use HasFactory;

    protected $table = "penalties";
    protected $fillable = ['member_id', 'penalty_percent','del_status'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
