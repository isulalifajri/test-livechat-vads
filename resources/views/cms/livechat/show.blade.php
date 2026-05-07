@extends('layouts.main')

@section('content')

<div class="row">

    {{-- Customer Info --}}
    <div class="col-lg-4 mb-4">

        <div class="card h-100">

            <div class="card-body">

                <div class="text-center mb-4">

                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            {{ strtoupper(substr($session->customer->name, 0, 1)) }}
                        </span>
                    </div>

                    <h5 class="mb-1">
                        {{ $session->customer->name }}
                    </h5>

                    @php

                        if($session->status == 'waiting') {

                            $badge = 'warning';

                        } elseif($session->status == 'active') {

                            $badge = 'success';

                        } else {

                            $badge = 'secondary';

                        }

                    @endphp

                    <span class="badge bg-{{ $badge }}">
                        {{ ucfirst($session->status) }}
                    </span>

                </div>

                <hr class="mb-4">

                <div class="mb-3">

                    <small class="text-muted d-block">
                        Email
                    </small>

                    <span class="fw-semibold">
                        {{ $session->customer->email }}
                    </span>

                </div>

                <div class="mb-3">

                    <small class="text-muted d-block">
                        Phone
                    </small>

                    <span class="fw-semibold">
                        {{ $session->customer->phone }}
                    </span>

                </div>

                <div class="mb-0">

                    <small class="text-muted d-block">
                        Created Date
                    </small>

                    <span class="fw-semibold">
                        {{ $session->created_at->format('d M Y H:i') }}
                    </span>

                </div>

            </div>

        </div>

    </div>

    {{-- Chat Room --}}
    <div class="col-lg-8">

        <div class="card">

            {{-- Header --}}
            <div class="card-header border-bottom">

                <div class="d-flex align-items-center">

                    <div class="avatar avatar-sm me-3">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            {{ strtoupper(substr($session->customer->name, 0, 1)) }}
                        </span>
                    </div>

                    <div>

                        <h6 class="mb-0">
                            {{ $session->customer->name }}
                        </h6>

                        <small class="text-muted">
                            Live Chat Conversation
                        </small>

                    </div>

                </div>

            </div>

            {{-- Messages --}}
            <div id="chatBox"
                 class="card-body"
                 style="height:500px;overflow-y:auto;background:#f8f9fa;">

                @foreach($session->messages as $message)

                    @if($message->sender_type == 'agent')

                        <div class="d-flex justify-content-start mb-4">

                            <div style="max-width:75%;">

                                <small class="fw-semibold d-block mb-1">
                                    {{ $session->agent->name ?? 'Agent' }} (Agent Support)
                                </small>

                                <div class="bg-white border rounded p-3">

                                    {{ $message->message }}

                                </div>

                                <small class="text-muted">
                                    {{ $message->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @else

                        <div class="d-flex justify-content-end mb-4">

                            <div style="max-width:75%; text-align:right;">

                                <small class="fw-semibold d-block mb-1">
                                    {{ $session->customer->name }} (Customer)
                                </small>

                                <div class="bg-primary text-white rounded p-3">

                                    {{ $message->message }}

                                </div>

                                <small class="text-muted">
                                    {{ $message->created_at->format('H:i') }}
                                </small>

                            </div>

                        </div>

                    @endif

                @endforeach

            </div>

            {{-- Form Chat --}}
            @if($session->status != 'closed')

            <div id="chatForm" class="card-footer border-top">

                <form id="chatFormSend">

                    @csrf

                    <div class="d-flex gap-2 align-items-end">

                        <div class="flex-grow-1">

                            <textarea id="messageInput"
                                    name="message"
                                    class="form-control"
                                    rows="2"
                                    placeholder="Type message..."
                                    style="resize:none;"></textarea>

                        </div>

                        <button class="btn btn-primary">

                            <i class="bx bx-send"></i>

                        </button>

                    </div>

                </form>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection

@push('js')

<script>

    const sessionId = {{ $session->id }};

    /*
    |--------------------------------------------------------------------------
    | LOAD MESSAGES
    |--------------------------------------------------------------------------
    */

    async function loadMessages() {

        try {

            const response = await fetch(
                `/chat/livechat/${sessionId}/messages`
            );

            const data = await response.json();

            let html = '';

            data.messages.forEach(message => {

                // AGENT
                if(message.sender_type === 'agent') {

                    html += `
                        <div class="d-flex justify-content-start mb-4">

                            <div style="max-width:75%;">

                                <small class="fw-semibold d-block mb-1">
                                    ${data.agent} (Agent Support)
                                </small>

                                <div class="bg-white border rounded p-3">

                                    ${message.message}

                                </div>

                                <small class="text-muted">
                                    ${new Date(message.created_at)
                                        .toLocaleTimeString('id-ID', {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}
                                </small>

                            </div>

                        </div>
                    `;

                } else {

                    // CUSTOMER
                    html += `
                        <div class="d-flex justify-content-end mb-4">

                            <div style="max-width:75%;text-align:right;">

                                <small class="fw-semibold d-block mb-1">
                                    ${data.customer} (Customer)
                                </small>

                                <div class="bg-primary text-white rounded p-3">

                                    ${message.message}

                                </div>

                                <small class="text-muted">
                                    ${new Date(message.created_at)
                                        .toLocaleTimeString('id-ID', {
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}
                                </small>

                            </div>

                        </div>
                    `;
                }

            });

            document.getElementById('chatBox').innerHTML = html;

            // auto scroll bawah
            const chatBox = document.getElementById('chatBox');

            chatBox.scrollTop = chatBox.scrollHeight;

            // hide form jika closed
            if(data.status === 'closed') {

                document.getElementById('chatForm').style.display = 'none';

            }

        } catch(error) {

            console.log(error);

        }
    }

    /*
    |--------------------------------------------------------------------------
    | SEND MESSAGE
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('chatFormSend');

    form.addEventListener('submit', async function(e) {

        e.preventDefault();

        const message = document
            .getElementById('messageInput')
            .value;

        if(message.trim() == '') {

            return;

        }

        try {

            await fetch(
                `/chat/livechat/${sessionId}/send`,
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN':
                            '{{ csrf_token() }}'
                    },

                    body: JSON.stringify({
                        message: message
                    })
                }
            );

            // kosongkan textarea
            document.getElementById('messageInput').value = '';

            // reload message
            loadMessages();

        } catch(error) {

            console.log(error);

        }

    });

    /*
    |--------------------------------------------------------------------------
    | REALTIME
    |--------------------------------------------------------------------------
    */

    loadMessages();

    setInterval(loadMessages, 5000);

</script>

<script>

    let currentStatus = '{{ $session->status }}';

    async function checkStatus() {

        try {

            const response = await fetch(
                `/chat/livechat/${sessionId}/status`
            );

            const data = await response.json();

            // kalau status berubah
            if(data.status !== currentStatus) {

                currentStatus = data.status;

                // reload halaman
                location.reload();

            }

        } catch(error) {

            console.log(error);

        }
    }

    // cek tiap 5 detik
    setInterval(checkStatus, 5000);

</script>

@endpush