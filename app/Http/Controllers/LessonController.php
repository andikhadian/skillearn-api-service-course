<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $lesson = Lesson::query();

        $chapterId = $request->query('chapter_id');

        $lesson->when($chapterId, function ($query) use ($chapterId) {
            return $query->where('chapter_id', '=', $chapterId);
        });

        return response()->json([
            'status' => 'success',
            'data' => $lesson->get()
        ], 200);
    }

    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return response()->json([
                'status' => 'success',
                'message' => 'lesson not found',
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'data' => $lesson,
        ], 200);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'video' => 'required|string',
            'chapter_id' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $chapterId = $request->input('chapter_id');
        $chapter = Chapter::find($chapterId);

        if (!$chapter) {
            return response()->json([
                'status' => 'error',
                'message' => 'chapter not found',
            ], 404);
        }

        $lesson = Lesson::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $lesson,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        if (!$lesson) {
            return response()->json([
                'status' => 'error',
                'message' => 'lesson not found',
            ], 404);
        }

        $rules = [
            'name' => 'required|string',
            'video' => 'required|string',
            'chapter_id' => 'required|integer',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $chapterId = $request->input('chapter_id');
        $chapter = Chapter::find($chapterId);

        if (!$chapter) {
            return response()->json([
                'status' => 'error',
                'message' => 'chapter not found',
            ], 404);
        }

        $lesson->fill($data);
        $lesson->save();

        return response()->json([
            'status' => 'success',
            'data' => $lesson,
        ], 200);
    }

    public function destroy($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return response()->json([
                'status' => 'success',
                'message' => 'lesson not found',
            ], 404);
        }
        $lesson->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'lesson deleted',
        ], 200);
    }
}
