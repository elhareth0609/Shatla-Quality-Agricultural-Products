<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Publication;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
  public function view($id) {
    $worker = Profile::find($id);
    $publications = Publication::where('user_id', $worker->user->id)->get();
    return view('content.home.workers.index')
    ->with('worker',$worker)
    ->with('publications',$publications);
    ;
  }

  public function all() {
    $experts = Profile::where('plan_id', 1)->get();
    return view('content.home.workers.all')
    ->with('experts', $experts);
  }
}
