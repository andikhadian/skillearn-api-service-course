<?php

namespace App\Http\Controllers;

use App\Course;
use App\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $chapters = Chapter::query();
        $courseId = $request->query('course_id');


        $chapters->when($courseId, function ($query) use ($courseId) {
            return $query->where('course_id', '=', $courseId);
        });

        return response()->json([
            'status' => 'success',
            'data' => $chapters->get(),
        ], 200);
    }

    public function show($id)
    {
        $chapter = Chapter::find($id);

        if (!$chapter) {
            return response()->json([
                'status' => 'success',
                'message' => 'chapter not found',
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'data' => $chapter,
        ], 200);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'course_id' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $courseId = $request->input('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found',
            ], 404);
        }

        $chapter = Chapter::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $chapter,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::find($id);
        if (!$chapter) {
            return response()->json([
                'status' => 'error',
                'message' => 'chapter not found',
            ], 404);
        }

        $rules = [
            'name' => 'required|string',
            'course_id' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $courseId = $request->input('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            return response()->json([
                'status' => 'error',
                'message' => 'course not found',
            ], 404);
        }

        $chapter->fill($data);
        $chapter->save();

        return response()->json([
            'status' => 'success',
            'data' => $chapter,
        ], 200);
    }

    public function destroy($id)
    {
        $chapter = Chapter::find($id);

        if (!$chapter) {
            return response()->json([
                'status' => 'success',
                'message' => 'chapter not found',
            ], 404);
        }
        $chapter->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'chapter deleted',
        ], 200);
    }
}
