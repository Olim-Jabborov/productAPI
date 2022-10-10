<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $colors = Color::all();
        
        return response()->json([
            'status' => 'success',
            'colors' => $colors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required|string|max:255'
        ]);

        $color = Color::create([
            'color' => $request->color
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Color created successfully',
            'color' => $color,
        ]);
    }

    public function show($id)
    {
        $color = Color::find($id);
        return response()->json([
            'status' => 'success',
            'color' => $color,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'color' => 'required|string|max:255'
        ]);

        $color = Color::find($id);
        $color->color = $request->color;
        $color->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Color updated successfully',
            'color' => $color,
        ]);
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        $color->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Color deleted successfully',
        ]);
    }
}
