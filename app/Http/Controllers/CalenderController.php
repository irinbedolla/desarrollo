<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudEvents;

class CalenderController extends Controller
{

    public function index(Request $request)
    {
        $events = [];
 
        $events = CrudEvents::all();
        foreach ($events as $event) {
            $events[] = [
                'title' => $event->event_name,
                'start' => $event->event_start,
                'end'   => $event->event_end,
            ];
        }

        //return response()->json($events);
        return view('calendar', compact('events'));
    }
 

    public function calendarEvents(Request $request)
    {
 
        switch ($request->type) {
           case 'create':
                $event = CrudEvents::create([
                    'event_name' => $request->event_name,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
                ]);
                return response()->json($event);
             break;
  
           case 'edit':
              $event = CrudEvents::find($request->id)->update([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);
 
              return response()->json($event);
             break;
  
           case 'delete':
              $event = CrudEvents::find($request->id)->delete();
  
              return response()->json($event);
             break;
             
           default:
             # ...
             break;
        }
    }

    public function obtenerHorarios(Request $request)
    {
        
    }
}