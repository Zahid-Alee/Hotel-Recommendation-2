<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function store(Request $request)
    {

        // $validated = $request->validate([
        //     'prompt' => 'required|string',
        // ]);

        // dd($request->input('prompt'));

        $history = History::create([
            'user_id' => Auth::user()->id,
            'prompt' => $request->input('prompt'),
        ]);

        return response()->json([
            'message' => 'History created successfully',
            'history' => $history,

        ], 201);
    }

    /**
     * Display the specified user's histories.
     */
    public function index()
    {
        $histories = History::where('user_id', Auth::user()->id)->get();
        return response()->json([
            'histories' => $histories,
        ]);
    }
}
