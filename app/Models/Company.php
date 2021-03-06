<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    protected $table = "company";

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company');
    }

    public function getCompanyLogoAttribute()
    {
        if (empty($this->logo)) {
            return Storage::url('avatar_default.jpg');
        } else {
            return Storage::url($this->logo);
        }
    }

    protected $appends = ['companyLogo'];
}
