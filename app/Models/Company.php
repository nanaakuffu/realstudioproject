<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    protected $table = "company";

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

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
