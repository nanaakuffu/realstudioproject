<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function getEmployeePictureAttribute()
    {
        if (empty($this->picture)) {
            return Storage::url('avatar_default.jpg');
        } else {
            return Storage::url($this->picture);
        }
    }

    protected $appends = ['fullName', 'companyName', 'employeePicture'];
}
