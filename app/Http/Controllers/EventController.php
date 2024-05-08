<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  public function index(Request $request) {
      $events = Event::where('user_id', Auth::user()->id)->get();

    return view('content.dashboard.events.index')
    ->with('events',$events);
  }

    public function create(Request $request) {
      $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start' => 'required|date_format:Y-m-d\TH:i',
        'end' => 'required|date_format:Y-m-d\TH:i|after:start',
        'color' => 'nullable|string|max:20'
      ]);

      if ($validator->fails()) {
          return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $validator->errors()->first()
          ], 422);
      }

      try {

        $event = new Event();
        $event->user_id = Auth::user()->id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->color = $request->color;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return response()->json([
          'icon' => 'success',
          'state' => __("Success"),
          'message' => __("Created Successfully."),
          'event' => $event
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'icon' => 'error',
          'state' => __("Error"),
          'message' => $e->getMessage(),
        ]);
      }
  }

  public function update(Request $request) {
    $validator = Validator::make($request->all(), [
      'id' => 'required|string',
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'start' => 'required|date_format:Y-m-d\TH:i',
      'end' => 'required|date_format:Y-m-d\TH:i|after:start',
      'color' => 'nullable|string|max:20'
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {

      $event = Event::find($request->id);
      $event->title = $request->title;
      $event->description = $request->description;
      $event->color = $request->color;
      $event->start = $request->start;
      $event->end = $request->end;
      $event->save();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Updated Successfully."),
        'event' => $event
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
  }

  public function delete(Request $request) {
    $validator = Validator::make($request->all(), [
      'id' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $validator->errors()->first()
        ], 422);
    }

    try {

      $event = Event::find($request->id);
      $event->delete();

      return response()->json([
        'icon' => 'success',
        'state' => __("Success"),
        'message' => __("Deleted Successfully."),
        'event' => $event
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'icon' => 'error',
        'state' => __("Error"),
        'message' => $e->getMessage(),
      ]);
    }
  }
}
