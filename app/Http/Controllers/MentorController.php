<?php

namespace App\Http\Controllers;

use App\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{

    public function index()
    {
        $mentors = Mentor::all();

        return response()->json([
            'status' => 'success',
            'data' => $mentors,
        ], 200);
    }

    public function show($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'success',
                'message' => 'mentor not found',
            ], 400);
        }
        return response()->json([
            'status' => 'success',
            'data' => $mentor,
        ], 200);
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'profile' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $mentor = Mentor::create($data);
        return response()->json([
            'status' => 'success',
            'data' => $mentor,
        ], 200);
    }

    public function update(Request $request, $id)
    {

        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'error',
                'message' => 'mentor not found',
            ], 400);
        }

        $rules = [
            'name' => 'required|string',
            'profile' => 'required|url',
            'profession' => 'required|string',
            'email' => 'required|email',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors(),
            ], 400);
        }

        $mentor->fill($data);
        $mentor->save();

        return response()->json([
            'status' => 'success',
            'data' => $mentor,
        ], 200);
    }

    public function destroy($id)
    {
        $mentor = Mentor::find($id);

        if (!$mentor) {
            return response()->json([
                'status' => 'success',
                'message' => 'mentor not found',
            ], 400);
        }
        $mentor->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'mentor deleted',
        ], 200);
    }
}
