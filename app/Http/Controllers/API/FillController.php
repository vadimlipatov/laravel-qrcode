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

class BitrixController extends Controller
{
  public function __invoke(Request $request)
  {
    define("WEBHOOK", "https://kombat.bitrix24.ru/rest/273/0s1xdvorwl20jdzs/");

    // $req = json_decode(file_get_contents("php://input"), true);

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

    // UF_CRM_19_1684665795520 // file

    // $contacts = executeRest(
    //   "crm.contact.list",
    //   [
    //     'order'  => ["DATE_CREATE" => "ASC"],
    //     'filter'  => [
    //       "TYPE_ID" => "CLIENT",
    //       ">ID"  => $req['fromId'],
    //       "<=ID" => $req['toId'],
    //     ],
    //     'select'  => ["ID", "NAME", "LAST_NAME"],
    //   ]
    // );

    // dd($contacts);

    // foreach ($contacts as $contact) {
    //   $res = Contact::firstOrCreate([
    //     'bitrix_id' => $contact['ID'] // уникальность
    //   ], [
    //     'name' => $contact['NAME'],
    //     'last_name' => $contact['LAST_NAME'],
    //   ]);
    // }

    $count = Contact::all()->count('id');
    $total = executeRest('crm.contact.list')['total'];

    return [
      'total' => $total,
      'now' => $count
    ];
  }
}
