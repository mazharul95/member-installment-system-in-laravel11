<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Installment extends Model
{
    use HasFactory;

    protected $table = "installments";
    protected $fillable = ['member_id', 'amount', 'due_date', 'paid_date', 'is_paid', 'penalty_amount','del_status'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
