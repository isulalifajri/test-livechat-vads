<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\ChatSession;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LiveChatController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'captcha' => 'required|captcha',
        ], [
            'captcha.captcha' => 'Captcha code does not match',
            'email.email' => 'Invalid email format',
        ]);

        // simpan customer
        $customer = Customer::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // buat session chat
        $session = ChatSession::create([
            'customer_id' => $customer->id,
            'status' => 'waiting',
            'queue_start' => now(),
        ]);

        return redirect()->route('queue.room', $session->id);
    }

    public function queue($id)
    {
        $session = ChatSession::findOrFail($id);

        return view('home', compact('session'));
    }

    public function status($id)
    {
        $session = ChatSession::findOrFail($id);

        // auto close jika lebih dari 3 menit
        if (
            $session->status == 'waiting' &&
            $session->queue_start &&
            // Carbon::parse($session->queue_start)->addMinutes(3)->isPast()
            Carbon::parse($session->queue_start)->addSeconds(20)->isPast()
        ) {

            $session->update([
                'status' => 'closed',
                'closed_at' => now(),
            ]);
        }

        return response()->json([
            'status' => $session->status,
        ]);
    }
}
