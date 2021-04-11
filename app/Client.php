<?php

namespace App;

use App\User as BasicUser;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Client extends BasicUser
{
   	use SoftDeletes;
}
