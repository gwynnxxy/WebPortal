<?php

namespace App\Http\Controllers;

use App\Http\Requests\fileRequest;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class files_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Files::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(fileRequest $request)
    {
        $Files = Files::create($request->validated());

        // return response()->json([$Files]);

        return $Files;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Files = Files::findOrFail($id);

        return $Files;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(fileRequest $request, string $id)
    {
        $validated = $request->validated();

        $Files = Files::findOrFail($id)->update($validated);

        return $Files;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Files = Files::findOrFail($id);

        $Files->delete();

        return $Files;
    }

    public function userFiles(string $id)
    {
        $leftJoin = DB::table('files')
            ->leftJoin('users', 'files.user_id', '=', 'users.user_id')
            ->select(
                'files.*',
            )
            ->where('users.user_id', $id)
            ->get();

        return $leftJoin;
    }

    public function latestFile(string $id)
    {
        $leftJoin = DB::table('files')
            ->leftJoin('users', 'files.user_id', '=', 'users.user_id')
            ->select(
                'files.*',
            )
            ->where('users.user_id', $id)
            ->orderBy('files.created_at', 'desc')
            ->take(5)
            ->get();

        return $leftJoin;
    }
}
