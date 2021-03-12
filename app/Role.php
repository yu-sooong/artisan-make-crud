<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = ['name'];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

}
