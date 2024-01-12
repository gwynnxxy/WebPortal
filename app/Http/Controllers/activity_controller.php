<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity_request;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class activity_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Activity::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Activity_request $request)
    {
        $activity = Activity::create($request->validated());

        // return response()->json([$activity]);

        // return $activity;
        // Return the created activity as a JSON response
        return response()->json([$activity]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = Activity::findOrFail($id);

        return $activity;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Activity_request $request, string $id)
    {
        $validated = $request->validated();

        $activity = Activity::findOrFail($id)->update($validated);

        return $activity;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);

        $activity->delete();

        return $activity;
    }

    public function activities()
    {
        $leftJoin = DB::table('activity')
            ->leftJoin('subjects', 'activity.sub_id', '=', 'subjects.sub_id')
            // ->leftJoin('users', 'activity.user_id', '=', 'users.user_id')
            ->select(
                'activity.*',
                'subjects.sub_name',
                // 'users.user_id',
            )
            // ->where('users.user_id', $id)
            ->get();

        return $leftJoin;
    }

    public function unfilData(string $id)
    {
        $leftJoin = DB::table('activity')
            ->leftJoin('subjects', 'activity.sub_id', '=', 'subjects.sub_id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.user_id')
            ->select(
                'activity.*',
                'subjects.sub_name',
            )
            ->where('users.user_id', $id)
            ->where('isDone', '=', 'false')
            ->get();

        return $leftJoin;
    }

    public function filData(string $id)
    {
        $leftJoin = DB::table('activity')
            ->leftJoin('subjects', 'activity.sub_id', '=', 'subjects.sub_id')
            ->leftJoin('users', 'activity.user_id', '=', 'users.user_id')
            ->select(
                'activity.*',
                'subjects.sub_name',
            )
            ->where('users.user_id', $id)
            ->where('isDone', '=', 'true')
            ->get();

        return $leftJoin;
    }

    public function latestActivity(string $id)
    {
        $leftJoin = DB::table('activity')
            ->leftJoin('users', 'activity.user_id', '=', 'users.user_id')
            ->select(
                'activity.*',
            )
            ->where('users.user_id', $id)
            ->orderBy('activity.created_at', 'desc')
            ->take(5)
            ->get();

        return $leftJoin;
    }
}
