<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $types = Type::all();
        
        return response()->json([
            'status' => 'success',
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255'
        ]);

        $type = Type::create([
            'type' => $request->type
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Type created successfully',
            'type' => $type,
        ]);
    }

    public function show($id)
    {
        $type = Type::find($id);
        return response()->json([
            'status' => 'success',
            'type' => $type,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255'
        ]);

        $type = Type::find($id);
        $type->type = $request->type;
        $type->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Type updated successfully',
            'type' => $type,
        ]);
    }

    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Type deleted successfully',
        ]);
    }
}
