<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'image', 'status',
    ];

    public function getAllClients()
    {
        return $this->all();
    }
}
