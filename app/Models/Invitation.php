<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    use HasFactory;

    protected $table = 'invitations';
    protected $primarykey = 'id';
    protected $fillable = [
        'employee_email',
        'societe_id',
        'status',
        'confirme',
    ];

    function employee() : BelongsTo {
        return $this->belongsTo(User::class, 'employee_email', 'email');
    }

    function societe() : BelongsTo {
        return $this->belongsTo(Societe::class);
    }
}
