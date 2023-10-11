<?php
namespace Controller;

use Model\CabinetItem;

class CabinetController
{
  private $query;

  public function __construct()
  {
    $this->query = CabinetItem::join('cabinets', 'cabinets_x_items.id_cabinet', '=', 'cabinets.id')
      ->join('items', 'cabinets_x_items.id_item', '=', 'items.id');
  }

  public function getAllCabinets(): Array
  {
    $allItems = $this->query->get()->toArray();

    return $this->buildCabinetArray($allItems);
  }

  public function getCabinet(int $id): Array
  {
    $cabinet = $this->query->where('id_cabinet', '=', $id)->get()->toArray();
    return $this->buildCabinetArray($cabinet);
  }

  private function buildCabinetArray($queryResult): Array
  {
    $cabinet = [];

    foreach ($queryResult as $element) {
      if(!array_key_exists($element['id_cabinet'], $cabinet ?? [])) {
        $cabinet[$element['id_cabinet']] = [
          'cabinet_id' => $element['id_cabinet'],
          'location' => $element['location'],
          'room' => $element['room'],
          'items' => [[
            'item_name' => $element['item_name'],
            'amount' => $element['amount'],
          ]],
        ];
        continue;
      }
      $cabinet[$element['id_cabinet']]['items'][] = [
        'item_name' => $element['item_name'],
        'amount' => $element['amount'],
      ];
    }

    return $cabinet;
  }
}