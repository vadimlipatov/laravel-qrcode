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
    // logger()->info($request);

    Contact::firstOrCreate([
      'item_id' => $request->item_id
    ], [
      'name' => $request->name,
      'last_name' => $request->last_name,
      'entity_type_id' => $request->entity_type_id,


    ]);

    return [
      'message' => 'add contact'
    ];
  }
}
