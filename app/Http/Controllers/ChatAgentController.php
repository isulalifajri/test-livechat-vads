<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatAgentController extends Controller
{
    public function index()
    {
        $sessions = ChatSession::with(['customer', 'agent'])
            ->orderByRaw("
                CASE
                    WHEN status = 'waiting' THEN 1
                    WHEN status = 'active' THEN 2
                    WHEN status = 'closed' THEN 3
                END
            ")
            ->latest()
            ->get();

        return view('cms.livechat.index', compact('sessions'));
    }

    public function show($id)
    {
        $session = ChatSession::with([
            'customer',
            'agent',
            'messages',
        ])->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | PERTAMA KALI DIBUKA AGENT
        |--------------------------------------------------------------------------
        */

        if ($session->status == 'waiting') {

            $session->update([
                'status' => 'active',
                'agent_id' => auth()->id(),
                'connected_at' => now(),
            ]);

            // auto greeting
            Message::create([
                'chat_session_id' => $session->id,
                'sender_type' => 'agent',
                'sender_id' => auth()->id(),
                'message' => 'Halo ' . $session->customer->name .
                    '. Saya Agent BOT, apa yang ingin kamu tanyakan?',
            ]);

            $session->refresh();
        }

        return view('cms.livechat.show', compact('session'));
    }

    /*
    |--------------------------------------------------------------------------
    | REALTIME MESSAGES
    |--------------------------------------------------------------------------
    */

    public function messages($id)
    {
        $session = ChatSession::with([
            'customer',
            'agent',
            'messages',
        ])->findOrFail($id);

        return response()->json([
            'status' => $session->status,
            'messages' => $session->messages,
            'customer' => $session->customer->name,
            'agent' => $session->agent->name ?? 'Agent',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $session = ChatSession::findOrFail($id);

        // stop jika closed
        if ($session->status == 'closed') {

            return response()->json([
                'success' => false,
            ]);
        }

        Message::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'agent',
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STATUS + IDLE CHECK
    |--------------------------------------------------------------------------
    */

    public function status($id)
    {
        $session = ChatSession::findOrFail($id);

        if ($session->status == 'active') {

            $lastMessage = Message::where(
                    'chat_session_id',
                    $session->id
                )
                ->latest()
                ->first();

            /*
            |--------------------------------------------------------------------------
            | CUSTOMER IDLE
            |--------------------------------------------------------------------------
            */

            if (
                $lastMessage &&
                $lastMessage->sender_type == 'agent' &&
                $lastMessage->message != 'Saya masih menunggu respons jawaban chat Bapak/Ibu.' &&
                $lastMessage->message != 'Mohon maaf, karena tidak ada respons chat dari Bapak/Ibu, saya akhiri chat ini.' &&

                // TEST
                // Carbon::parse($lastMessage->created_at)
                //     ->addSeconds(10)
                //     ->isPast()

                // REAL
                Carbon::parse($lastMessage->created_at)
                    ->addMinutes(3)
                    ->isPast()
            ) {

                Message::create([
                    'chat_session_id' => $session->id,
                    'sender_type' => 'agent',
                    'sender_id' => $session->agent_id,
                    'message' => 'Saya masih menunggu respons jawaban chat Bapak/Ibu.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | AUTO CLOSE
            |--------------------------------------------------------------------------
            */

            $lastMessage = Message::where(
                    'chat_session_id',
                    $session->id
                )
                ->latest()
                ->first();

            if (
                $lastMessage &&
                $lastMessage->message == 'Saya masih menunggu respons jawaban chat Bapak/Ibu.' &&

                // TEST
                // Carbon::parse($lastMessage->created_at)
                //     ->addSeconds(10)
                //     ->isPast()

                // REAL
                Carbon::parse($lastMessage->created_at)
                    ->addMinutes(1)
                    ->isPast()
            ) {

                Message::create([
                    'chat_session_id' => $session->id,
                    'sender_type' => 'agent',
                    'sender_id' => $session->agent_id,
                    'message' => 'Mohon maaf, karena tidak ada respons chat dari Bapak/Ibu, saya akhiri chat ini.',
                ]);

                $session->update([
                    'status' => 'closed',
                    'closed_at' => now(),
                ]);
            }
        }

        return response()->json([
            'status' => $session->status,
        ]);
    }
}