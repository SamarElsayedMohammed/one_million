<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class People extends Model
{
    use Searchable;
    use HasFactory;
    protected $guarded = [];


    public function toSearchableArray()
    {
        return [
            'User_Id' => $this->User_Id,
            'First_Name' => $this->First_Name,
            'Last_Name' => $this->Last_Name,
            'Phone' => $this->Phone,
            'Email' => $this->Email,
            'Sex' => $this->Sex,
            'Date_of_birth' => $this->Date_of_birth,
            'Job_Title' => $this->Job_Title,
        ];
    }
}
