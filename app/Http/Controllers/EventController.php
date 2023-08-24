<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{

    private $auth_user;

    public function __construct()
    {
        $user_id = session('user');
        if ($user_id != null) {
            $user = User::find($user_id);
            if($user != null)
            {
                $this->auth_user = $user->id;
            } else {
                dd( "INVALID USER SESSION");
            }

        }
    }

    public function index(Request $request)
    {
        $type = $request->input('type');

        $events = Event::where('status','published')->with('cheapest');
        if(!empty($type)) {
            $events =  $events->where(['event_type_code'=> $type]);
        }

        $events = $events->take(6)->latest()->get();
        $event_types = EventType::all();
        $data = [
            'event_types' => $event_types,
            'events' => $events,
        ];

        return view('event.index', $data);
    }

    public function show($slug)
    {
        $event = Event::where(['slug' => $slug, 'status' => 'published'])->first();
        $data = ['event' => $event];
        return view('event.show', $data);
    }
}
