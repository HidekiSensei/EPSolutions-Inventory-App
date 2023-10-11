<?php
namespace Controller;

use Model\CabinetItem;

class ItemController
{
  private $query;

  public function __construct()
  {
    $this->query = CabinetItem::join('cabinets', 'cabinets_x_items.id_cabinet', '=', 'cabinets.id')
      ->join('items', 'cabinets_x_items.id_item', '=', 'items.id');
  }

  public function getAllItems(): Array
  {
    $allItems = $this->query->get()->toArray();

    return $this->buildItemArray($allItems);
  }

  public function getItem(int $id): Array
  {
    $item = $this->query->where('items.id', '=', $id)->get()->toArray();
    return $this->buildItemArray($item);
  }

  private function buildItemArray($queryResult): Array
  {
    $item = [];

    foreach ($queryResult as $element) {
      if(!array_key_exists($element['id_item'], $item ?? [])) {
        $item[$element['id_item']] = [
          'item_name' => $element['item_name'],
          'cabinets' => [[
            'id_cabinet' => $element['id_cabinet'],
            'location' => $element['location'],
            ]],
        ];
        continue;
      }
      $item[$element['id_item']]['cabinets'][] = [
        'id_cabinet' => $element['id_cabinet'],
        'location' => $element['location'],
        'room' => $element['room'],
        'amount' => $element['amount'],
      ];
    }

    return $item;
  }
}