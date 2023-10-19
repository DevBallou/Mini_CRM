<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'email',
        'societe_id'
    ];

    public function societe() : BelongsTo {
        return $this->belongsTo(Societe::class, 'societe_id');
    }

    function invitation() : HasOne {
        return $this->hasOne(Invitation::class, 'employee_email', 'email');
    }
}
