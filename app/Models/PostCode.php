<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    use HasFactory;

    protected $fillable = ['post_code','urban_village','sub_district','city','province'];

    //set upper attribute before insert
    public function setAttribute($key, $value)
    {

    if(in_array($key, ['urban_village','sub_district','city','province'])){
        $this->attributes[$key] = strtoupper($value);

        return $this;
    }

    return parent::setAttribute($key, $value);
    }

    //set date with format y-m-d
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d'
    ];

    /*
    public function getCityAttribute($value)
    {
        return ucfirst($value);
    }
    */

}
