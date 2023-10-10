<?php

namespace Model;

use Model\CabinetItem;
use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
  protected $table = 'cabinets';

  protected $primaryKey = 'id';

  public $timestamps = false;

  public function items()
  {
    return $this->belongsToMany(Item::class, 'cabinet_x_item', 'id_cabinet', 'id_item')
      ->using(CabinetItem::class);
  }
}
