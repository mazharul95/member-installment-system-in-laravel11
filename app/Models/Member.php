<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\Installment;
use App\Models\penalty;


/**
 * @method static findOrFail(string $id)
 */
class Member extends Model
{
    use HasFactory;

    protected $table = "members";
    protected $fillable = ['name', 'email', 'phone','address','del_status'];

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    public function penalty(): HasOne
    {
        return $this->hasOne(Penalty::class);
    }
}
