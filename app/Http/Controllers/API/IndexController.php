<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function __invoke(Request $request)
  {
    $members = Member::all();

    return MemberResource::collection($members)->resolve();
  }
}
