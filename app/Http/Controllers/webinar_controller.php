<?php

namespace App\Http\Controllers;

use App\Http\Requests\webinarRequest;
use App\Models\Webinars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class webinar_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Webinars::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(webinarRequest $request)
    {
        $Webinars = Webinars::create($request->validated());

        // return response()->json([$Webinars]);

        return $Webinars;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Webinars = Webinars::findOrFail($id);

        return $Webinars;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(webinarRequest $request, string $id)
    {
        $validated = $request->validated();

        $Webinars = Webinars::findOrFail($id)->update($validated);

        return $Webinars;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Webinars = Webinars::findOrFail($id);

        $Webinars->delete();

        return $Webinars;
    }

    public function webinars(string $id)
    {
        $leftJoin = DB::table('webinars')
            ->leftJoin('subjects', 'webinars.sub_id', '=', 'subjects.sub_id')
            ->leftJoin('webinar_type', 'webinars.type_id', '=', 'webinar_type.type_id')
            ->leftJoin('users', 'webinars.user_id', '=', 'users.user_id')
            ->select(
                'webinars.*',
                'subjects.sub_name',
                'webinar_type.web_name'
            )
            ->where('users.user_id', $id)
            ->get();

        return $leftJoin;
    }

    public function latestWebinar(string $id)
    {
        $leftJoin = DB::table('webinars')
            ->leftJoin('users', 'webinars.user_id', '=', 'users.user_id')
            ->select(
                'webinars.*',
            )
            ->where('users.user_id', $id)
            ->orderBy('webinars.created_at', 'desc')
            ->take(5)
            ->get();

        return $leftJoin;
    }
}
