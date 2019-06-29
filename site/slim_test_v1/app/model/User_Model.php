<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Model extends Model {

  protected $table = 'users';

  protected $fillable = ['name', 'email', 'password'];

}
