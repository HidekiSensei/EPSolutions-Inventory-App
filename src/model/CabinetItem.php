<?php
namespace Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CabinetItem extends Pivot
{
  protected $table = 'cabinets_x_items';

  public $timestamps = false;
}
