<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Event;
use App\Models\EventPackage;
use App\Models\Order;
use App\Models\OrderInformation;
use App\Models\User;
use App\Models\UserBalance;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private $auth_user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth_user = session('user_id');
            return $next($request);
        });
    }

    public function index()
    {
        if (empty($this->auth_user)) {
            return redirect('/login');
        }

        $orders = Order::where(['user_id' => $this->auth_user])->get();
        $data = ['orders' => $orders];

        return view('order.index', $data);
    }

    public function show($encoded_invoice){
        if (empty($this->auth_user)) {
            return redirect('/login');
        }

        $invoice_no = base64_decode($encoded_invoice);
        $order = Order::with('information')->where(['invoice_no' => $invoice_no,'user_id' => $this->auth_user])->first();

        $data = ['order' => $order];
        return view('order.show', $data);
    }

    public function chart($slug, $package_id)
    {
        $event = Event::where(['slug' => $slug])->whereHas('packages', function ($q) use ($package_id) {
            $q->where(['id' => $package_id]);
        })->first();

        $user = User::find($this->auth_user);

        $data = [
            'event' => $event,
            'user' => $user,
        ];

        return view('order.chart', $data);
    }

    public function chartAction(OrderRequest $request, $slug, $package_id): RedirectResponse
    {
        if (empty($this->auth_user)) {
            return redirect()->intended('/events/' . $slug . '/order' . $package_id)
                ->with('errors', 'You need to login to make an order');
        }

        $event = Event::where(['slug' => $slug])->first();
        $package = EventPackage::find($package_id);

        if (empty($event) || empty($package)) {
            return redirect('event.not_found');
        }

        $user = User::find($this->auth_user);
        if ($user == null) {
            return redirect()->intended('/events/' . $slug . '/order' . $package_id)
                ->with('errors', 'User is invalid');
        }

        $order = new Order();
        $order->invoice_no = $this->generateInvoiceNo($user->id, $package->id);
        $order->user_id = $user->id;
        $order->event_id = $event->id;
        $order->promoter_id = $event->promoter_id;
        $order->package_id = $package->id;
        $order->status = Order::STATUS_PAID;
        $order->event_slug = $event->slug;
        $order->event_title = $event->title;
        $order->event_description = $event->description;
        $order->event_banner = $event->banner;
        $order->event_date = $event->date;
        $order->event_selected_package_name = $package->name;
        $order->qty = 1;
        $order->price = $package->price;
        $order->tax = $package->tax;
        $order->total_amount = $package->total_amount;
        $order->payment_method = $request->input('payment_method');
        $order->save();

        $info = new OrderInformation();
        $info->order_id = $order->id;
        $info->first_name = $request->input('first_name');
        $info->last_name = $request->input('last_name');
        $info->phone = $request->input('phone');
        $info->email = $request->input('email');
        $info->save();

        $balance = new UserBalance();
        $balance->user_id = $order->user_id;
        $balance->order_id = $order->id;
        $balance->transaction_type = UserBalance::TRX_TYPE_ORDER;
        $balance->doc_no = $order->invoice_no;
        $balance->debit = $order->total_amount;
        $balance->credit = 0;
        $balance->save();

        $encoded = base64_encode($order->invoice_no);
        return redirect()->intended('/users/orders/'.$encoded)->with('status', 'Payment is success');
    }

    private function generateInvoiceNo(int $user_id, int $package_id): string
    {
        return "INV/" . $user_id . "/" . $package_id . "/" . Carbon::now()->timestamp;
    }
}
