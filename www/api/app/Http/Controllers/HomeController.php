<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller {

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function showAllLessons() {

        $lessons = Lesson::take(10)->offset(3)
                ->orderBy('id', 'desc')
                ->get();

        //$status = !is_null($lessons) ? 1 : 0;
        //return response()->json(['status' => $status, 'message' => 'Lessons data', 'data' => $lessons]);

        return $this->successResponse($lessons);
    }

    public function showLessonData($id) {

        $lessons = Lesson::find($id);

        $status = !is_null($lessons) ? 1 : 0;

        return response()->json(['status' => $status, 'message' => 'Lesson data', 'data' => $lessons]);
    }

    /* public function showOneAuthor($id)
      {
      return response()->json(Author::find($id));
      }

      public function create(Request $request)
      {
      $author = Author::create($request->all());

      return response()->json($author, 201);
      }

      public function update($id, Request $request)
      {
      $author = Author::findOrFail($id);
      $author->update($request->all());

      return response()->json($author, 200);
      }

      public function delete($id)
      {
      Author::findOrFail($id)->delete();
      return response('Deleted Successfully', 200);
      } */
}
