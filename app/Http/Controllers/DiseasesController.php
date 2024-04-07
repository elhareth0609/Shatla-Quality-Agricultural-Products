<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiseasesController extends Controller
{
    public function index() {
      $items = Disease::all();
      return view('content.home.diseases.index')
      ->with('items',$items);
    }

    public function predict(Request $request) {

    if ($request->isMethod('GET')) {
        return view('content.home.diseases.predict');
    }

    $file = $request->file('file');

    // Upload the photo to the API
    $response = Http::attach(
        'file',
        $file->get(),
        $file->getClientOriginalName()
    )->post('http://localhost:8080/predict');

        // Check if the request was successful
        if ($response->successful()) {
          // Get the response JSON
          $responseData = $response->json();

          // Do something with the response data
          $predictedClass = $responseData['class'];
          $confidence = $responseData['confidence'];
          dd($predictedClass, $confidence,$request->all());

          return view('content.home.diseases.predict')
              ->with('predictedClass', $predictedClass)
              ->with('confidence', $confidence);
        } else {
          // Handle error if the request was not successful
          $errorCode = $response->status();
          $errorMessage = $response->body();
          dd($errorCode, $errorMessage,$request->all());

          return view('content.home.diseases.predict')
              ->with('errorCode', $errorCode)
              ->with('errorMessage', $errorMessage);
        }


    }
}
