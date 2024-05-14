<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Disease;
use App\Models\Type;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiseasesController extends Controller
{
    public function index() {
      $items = Type::all();
      return view('content.home.diseases.index')
      ->with('items',$items);
    }

    public function predict(Request $request,$id) {

    if ($request->isMethod('GET')) {
        $type = Type::find($id);
        return view('content.home.diseases.predict')
        ->with('type',$type);
    }

    $request->validate([
      'file' => 'required|file|mimes:jpeg,png,pdf',
    ]);

    $file = $request->file('file');


    $response = Http::attach(
        'file',
        $file->get(),
        $file->getClientOriginalName()
    )->post('http://localhost:8080/predict');


    if ($response->successful()) {

        $responseData = $response->json();

        $class = $responseData['class'];
        if ($class == 'Early Blight') {
          $class = 'early blight';
        } else if ($class == 'Late Blight') {
          $class = 'late blight';
        } else if ($class == 'Healthy') {
          $class = 'healthy';
        }
        $confidence = $responseData['confidence'];

        $disease = Disease::where('name_en',$class)->first();
        $article = Article::where('disease_id', $disease->id)
                            ->where('type_id', $id)
                            ->first();


        $myDisease = new \stdClass();
        $myDisease->confidence = $confidence;

        $article->myDisease = $myDisease;
        return view('content.home.articles.ones')
        ->with('disease', $disease)
        ->with('article', $article);

        } else {

          $errorCode = $response->status();
          $errorMessage = $response->body();
          dd($errorCode, $errorMessage,$request->all());

          return view('content.home.diseases.predict')
              ->with('errorCode', $errorCode)
              ->with('errorMessage', $errorMessage);
        }


    }
}
