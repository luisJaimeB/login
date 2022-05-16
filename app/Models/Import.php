<?php

namespace App\Models;

use App\Constants\ImportStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'errors',
        'import_type',
        'import_status',
    ];

    protected $casts = [
        'errors' => 'array',
    ];

    public function completeWithErrors(): bool
    {
        return $this->attributes['import_status'] === ImportStatus::COMPLETERRORS;
    }

    public function getErrorsAttribute(): array
    {
        return json_decode(stripcslashes(trim($this->attributes['errors'],'"')), true);
    }
}
