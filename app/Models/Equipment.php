<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{


  protected $table = "equipment"; 
    protected $fillable =[
        "name",
        "status",
       "quantity"
    ];
    
 
/*public function equipment()
{
    return $this->hasMany(GymSession::class, 'equipment_id');
}*/

}
