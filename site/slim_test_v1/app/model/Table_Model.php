<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Model extends Model {

    protected $strTable = 'TBL_USER';

    protected $fillable = ['USER_USERNAME', 'USER_MAIL', 'USER_PASSWORD'];

}
