<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Item;
use Illuminate\Http\Request;
use Throwable;

class ActivitiesController extends Controller
{
    public function store(Request $request)
    {
        
        try{
            $activity = new Activity();
            $activity->activity_name = $request->activity;
            $activity->save();

            return response()->json([
                'type'       => 'activities',
                'message'    => 'Success',
                'id'         => $activity->id,
                'attributes' => $activity
            ], 201);
        }
        catch(Throwable  $e){

            return response()->json([
                'type'    => 'activities',
                'message' =>  'Fail'
            ], 400);
        }
    }

    public function storeItems(Request $request, $activity_id)
    {

        try{
            $item = new Item();
            $item->item_name   = $request->item_name;
            $item->activity_id = $activity_id;
            $item->status      = $request->status;
            $item->save();

            return response()->json([
                'type'       => 'items',
                'message'    => 'Success',
                'id'         => $item->id,
                'attributes' => $item
            ],201);
        }
        catch(Throwable  $e){
            
            return response()->json([
                'type'    => 'items',
                'message' => 'Fail',
                'error'   => $e
            ],400);
        }
       
    }

    public function show()
    {

        try{
            $activitiesList = Activity::all();
            $data = array();
            foreach($activitiesList as $activity)
            {
                $data[] = [
                    $activity->id => $activity,
                        'items' => Item::where('activity_id', $activity->id)->get()
                ];
            }

         return response()->json([
            'type'     => 'list',
            'message' => 'Success',
            'list'    => $data
         ],200);

        }
        catch(Throwable $e){

            return response()->json([
                'message'=>'Not Found',
                'error'  => $e
            ],404);
        }
    }

    public function getActivityById($activity_id)
    {
        try{

            $activity = Activity::where('id', $activity_id)->first();
            $data     = array(
                $activity->id => $activity,
                    'items' => Item::where('activity_id', $activity->id)->get()
            );

            return response()->json([
                'type'     => 'Activities list',
                'message' =>  'Success',
                'list'    =>   $data
            ],200);
    

        }catch(Throwable $e){

            return response()->json([
                'type'     => 'Activities List',
                'message'  => 'Not Found',
                'error'    => $e
            ],404);

        }
    }

    public function activityUpdate(Request $request, $activityUpdate)
    {
     
        try{
            $activity = Activity::where('id', '=', $activityUpdate)->firstOrFail();
            Activity::where('id', '=', $activityUpdate)->update(["activity_name" => $request->activity_name]);
           
            return response()->json([
                'type'     => 'Activities Update',
                'message' =>  'Success',
                'attributes' => $activity
            ],200);

        }catch(Throwable $e){

            return response()->json([
                'type'     => 'Activities Update',
                'message'  => 'Fail',
                'error'    => $e
            ],400);

        }

    }

    public function itemUpdate(Request $request, $activity_id, $item_id)
    {
        try{
            $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->firstOrFail();
            $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->update([
                "item_name" => $request->item_name,
                "status"    => $request->status
            ]);

            return response()->json([
                'type' => 'Item Update',
                'message' => 'Success',
                'attributes' => $item
            ],200);

        }catch(Throwable $e){

            return response()->json([
                'type' => 'Item Update',
                'message' => 'fail',
                'error' => $e
            ],400);

        }
    }

    public function activityDestroy($activity_id)
    {

        try{
            $activity = Activity::where('id', $activity_id)->firstOrFail();
            $activity = Activity::where('id', $activity_id)->delete();

            return response()->json([
                'type' => 'Activity Destroy',
                'message' => 'Success',
                'response' => $activity
            ],200);

        }catch(Throwable $e){

            return response()->json([
                'type' => 'Activity Destroy',
                'message' => 'fail',
                'error' => $e
            ],400);

        }

    }

    public function itemDestroy($activity_id, $item_id)
    {

        try{
            $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->firstOrFail();
            $item = Item::where('activity_id', $activity_id)->where('id', $item_id)->delete();

            return response()->json([
                'type' => 'Item Destroy',
                'message' => 'Success',
                'response' => $item
            ],200);

        }catch(Throwable $e){

            return response()->json([
                'type' => 'Item Destroy',
                'message' => 'fail',
                'error' => $e
            ],400);
            
        }

    }
}