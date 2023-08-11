<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use App\Models\Promoter;
use App\Models\UserBalance;
use Illuminate\Http\Request;

class PromoterController extends Controller
{
    private $auth_user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = session('user_id');

            if (empty($this->auth_user)) {
                return redirect('/login');
            }

            return $next($request);
        });
    }
    public function balance(){
        $balances = UserBalance::where(['user_id' => $this->auth_user])->get();

        $data = ['balances' => $balances];
        return view('promoter.balance', $data);
    }

    public function event(){

        $promoter = Promoter::where(['user_id'=>$this->auth_user])->first();
        if (empty($promoter)) {
            return redirect('/login');
        }

        $events = Event::where(['promoter_id'=>$promoter->id ])->get();
        $data = ['events'=>$events];

        return view('promoter.event.list', $data);
    }

    public function showEvent(){
        $data = [];
        return view('promoter.event.update', $data);
    }

    public function createEvent(){
        $event_types = EventType::all();

        $data = ['event_types' => $event_types];
        return view('promoter.event.create', $data);
    }

    public function createEventAction(){
        $event_types = EventType::all();

        $data = ['event_types' => $event_types];
        return view('promoter.event.create', $data);
    }
}
