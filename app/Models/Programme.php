<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Programme extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'programmes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'name_ar',
        'price',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function PROGRAM_Active()
    {
        return [
            'Bio-Health Informatics'        => 'Bio-Health Informatics',
            'Egyptology by Dr. Zahi Hawass' => 'Egyptology by Dr. Zahi Hawass',
        ];
    }
    public function programUsers()
    {
        return $this->hasMany(User::class, 'program_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
