<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Member;
use App\Models\Contact;
use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function __invoke(Request $request)
  {
    $contact = Contact::where('item_id', $request->itemId)->first();

    $member = Member::firstOrCreate(
      [
        'name' => $contact->name
      ], // unique
      [
        'last_name' => $contact->last_name,
        'item_id' => $contact->item_id,
        'entity_type_id' => $contact->entity_type_id

      ]
    );

    // смарт-процесс должен перейти на статус "Пришел на мероприятие"
    define("WEBHOOK", "https://kombat.bitrix24.ru/rest/273/0s1xdvorwl20jdzs/");

    function executeRest($method, $params = array())
    {
      $queryUrl = WEBHOOK . $method . '.json';
      $queryData = http_build_query($params);

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $queryUrl,
        CURLOPT_POSTFIELDS => $queryData,
      ));

      $result = curl_exec($curl);
      curl_close($curl);

      return json_decode($result, true);
    }

    $res = executeRest(
      "crm.item.update",
      [
        'entityTypeId' => $contact->entity_type_id, // 163
        'id'  => $contact->item_id,
        'fields' => [
          "stageId" => 'DT163_29:UC_0K78KQ' // final stage
        ]
      ]
    );

    logger()->info($res);


    return [
      'id' => $member['id'],
      'name' => $member['name'],
      'lastName' => $member['last_name'],
      'createdAt' => $member['created_at']->format('d-m-Y H:i')
    ];
  }
}
