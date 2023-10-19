<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Societe extends Model
{
    use HasFactory;

    protected $table = 'societes';
    protected $primarykey = 'id';
    protected $fillable = [
        'title',
        'name',
        'adresse',
        'ville',
        'code_postal',
        'telephone',
        'pays',
        'filiale',
        'user_id',
    ];

    function invitation() : HasOne {
        return $this->hasOne(Invitation::class, 'societe_id');
    }
}
