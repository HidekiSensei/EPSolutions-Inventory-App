<?php

namespace Model;

use Model\CabinetItem;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = 'items';

  protected $primaryKey = 'id';

  public $timestamps = false;

  public function cabinets()
  {
    return $this->belongsToMany(Cabinet::class, 'cabinet_x_item', 'id_item', 'id_cabinet')
      ->using(CabinetItem::class)
      ->withTimestamps();
  } 
}
