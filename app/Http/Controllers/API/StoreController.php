<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Member;
use App\Models\Post;
use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function __invoke(Request $request)
  {
    define("WEBHOOK", "https://sotnikovstudio.bitrix24.ru/rest/255/cm5iyc5ji51fi1ky/");

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

    $contact = executeRest(
      "crm.contact.get",
      [
        'id'  => $request->id
      ]
    )['result'];

    $comment = executeRest(
      "crm.contact.update",
      [
        'id'  => $request->id,
        'fields' => [
          "COMMENTS" => 'qr'
        ]
      ]
    );

    $member = Member::firstOrCreate([
      'name' => $contact['NAME'] // уникальность
    ], [
      'content' => $contact['ID']
    ]);



    // return MemberResource::make($member)->resolve();
    return [
      'id' => $contact['ID'],
      'name' => $contact['NAME'],
      'lastName' => $contact['LAST_NAME'],
      'secondName' => $contact['SECOND_NAME'],
      'comments' => $contact['COMMENTS'],
    ];
  }
}
