<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = "employee";

    protected $fillable = [
        "first_name",
        "last_name",
        "company",
        "email",
        "phone",
        "picture"
    ];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getCompanyNameAttribute(): string
    {
        return Company::where('id', $this->company)->first()->name;
    }

    protected $appends = ['fullName', 'companyName'];
}
