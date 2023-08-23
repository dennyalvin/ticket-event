<?php

namespace App\Http\Controllers;

use App\Helpers\StringHelper;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StoreWithdrawRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\EventPackage;
use App\Models\EventType;
use App\Models\Promoter;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;

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

    public function balance()
    {
        $balances = UserBalance::where(['user_id' => $this->auth_user])->get();

        $data = ['balances' => $balances];
        return view('promoter.balance.list', $data);
    }

    private function user_total_balance() : float{
        $total_balances = DB::table('user_balances')
            ->select(DB::raw('sum(debit - credit) as total'))
            ->where('user_id', $this->auth_user)
            ->first();

        return $total_balances->total ? $total_balances->total : 0;
    }

    public function withdraw()
    {
        return view('promoter.balance.withdraw', ['total_balance' => $this->user_total_balance()]);
    }

    public function withdrawAction(StoreWithdrawRequest $request)
    {
        if($request->input('amount') > $this->user_total_balance()) {
            return redirect()->route('promoter.balance.withdraw')
                ->withErrors('Insufficient withdraw amount request');
        }

        $balances = new UserBalance();
        $balances->user_id = $this->auth_user;
        $balances->debit = 0;
        $balances->credit = $request->input('amount');
        $balances->transaction_type = UserBalance::TRX_TYPE_WITHDRAW;
        $balances->save();

        return redirect()->route('promoter.balance')->with('success_message', 'Successfully withdraw');;
    }

    public function event()
    {
        $promoter = Promoter::where(['user_id' => $this->auth_user])->first();
        if (empty($promoter)) {
            return redirect('/login');
        }

        $events = Event::where(['promoter_id' => $promoter->id])->get();
        $data = ['events' => $events];

        return view('promoter.event.list', $data);
    }

    public function showEvent($encoded_id)
    {
        $event_id = base64_decode($encoded_id);

        $event = Event::find($event_id);

        $event_types = EventType::all();
        $data = [
            'event' => $event,
            'encoded_id' => $encoded_id,
            'event_types' => $event_types
        ];

        return view('promoter.event.update', $data);
    }

    public function updateEventAction(UpdateEventRequest $request, $encoded_id)
    {
        $event_id = base64_decode($encoded_id);

        $event = Event::find($event_id);

        $promoter = Promoter::where(['user_id' => $this->auth_user])->first();


        $title = $request->input('title');

        $event->promoter_id = $promoter->id;
        $event->event_type_code = $request->input('event_type_code');
        $event->title = $title;
        $event->description = $request->input('description');
        $event->banner = 'https://picsum.photos/200/300';
        $event->slug = StringHelper::generateSlug($title);
        $event->date_on = $request->input('date_on');
        $event->location_address = $request->input('location_address');
        $event->redemption_desc = $request->input('redemption_desc');
        $event->term_condition = $request->input('term_condition');
        $event->addition_information = $request->input('additional_information');
        $event->status = $request->input('status');

        $event->save();

        foreach ($request->input('package_id') as $i => $pck) {
            $package = EventPackage::find($pck);

            $package->name = $request->input('package_name')[$i];
            $package->quota = $request->input('package_quota')[$i];
            $package->price = $request->input('package_price')[$i];
            $package->tax = 0;
            $package->save();
        }

        $event_types = EventType::all();

        return redirect()->route('promoter.event.detail', ['encoded_id' => $encoded_id]);
    }

    public function createEvent()
    {
        $event_types = EventType::all();

        $data = ['event_types' => $event_types];
        return view('promoter.event.create', $data);
    }

    public function createEventAction(StoreEventRequest $request)
    {
        $promoter = Promoter::where(['user_id' => $this->auth_user])->first();

        $title = $request->input('title');
        $new_event = new Event();
        $new_event->promoter_id = $promoter->id;
        $new_event->event_type_code = $request->input('event_type_code');
        $new_event->title = $title;
        $new_event->description = $request->input('description');
        $new_event->banner = 'https://picsum.photos/200/300';
        $new_event->slug = StringHelper::generateSlug($title);
        $new_event->date_on = $request->input('date_on');
        $new_event->location_address = $request->input('location_address');
        $new_event->redemption_desc = $request->input('redemption_desc');
        $new_event->term_condition = $request->input('term_condition');
        $new_event->addition_information = $request->input('additional_information');
        $new_event->status = $request->input('status');

        $new_event->save();

        foreach ($request->input('package_name') as $i => $pck) {
            $package = new EventPackage();
            $package->event_id = $new_event->id;
            $package->name = $pck;
            $package->quota = $request->input('package_quota')[$i];
            $package->price = $request->input('package_price')[$i];
            $package->tax = 0;
            $package->save();
        }

        $event_types = EventType::all();

        $data = ['event_types' => $event_types];
        return view('promoter.event.create', $data);
    }
}
