<?php

namespace App\Http\Controllers;

use App\Http\Requests\subjectRequest;
use App\Models\Subjects;
use Illuminate\Http\Request;

class subject_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Subjects::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(subjectRequest $request)
    {
        $Subjects = Subjects::create($request->validated());

        // return response()->json([$Subjects]);

        return $Subjects;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Subjects = Subjects::findOrFail($id);

        return $Subjects;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(subjectRequest $request, string $id)
    {
        $validated = $request->validated();

        $Subjects = Subjects::findOrFail($id)->update($validated);

        return $Subjects;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Subjects = Subjects::findOrFail($id);

        $Subjects->delete();

        return $Subjects;
    }
}
