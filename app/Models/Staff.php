<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';
    protected $fillable = ['fname','lname'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    protected function fname():Attribute {
        return Attribute::make(
            set: fn ($value) => ucfirst($value),
            get: fn ($value) => $value
        );
    }

    protected function lname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
        );
    }
}
