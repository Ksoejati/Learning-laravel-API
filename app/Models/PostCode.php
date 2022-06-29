<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    use HasFactory;

    protected $fillable = ['post_code','urban_village','sub_district','city','province'];

    public function setAttribute($key, $value)
    {

    if(in_array($key, ['urban_village','sub_district','city','province'])){
        $this->attributes[$key] = strtoupper($value);

        return $this;
    }

    return parent::setAttribute($key, $value);
    }

    /*
    public function getCityAttribute($value)
    {
        return ucfirst($value);
    }
    */

}
