<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table 		= "customers";
    protected $primaryKey 	= "id";

    protected $fillable = [
        "name",
        "email",
        "birthDate",
        "cpf",
        "street",
        "number",
        "complements",
        "neighborhood",
        "zip",
        "city",
        "states",
        "lat",
        "lng",
    ];

    protected $guarded = [];

    protected $hidden = [];
}
