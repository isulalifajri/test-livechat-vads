<div id="chatHeader"
     class="d-flex justify-content-between align-items-center">

    <span>
        Live Chat Support
    </span>

    <small class="text-success fw-semibold">
        Online
    </small>

</div>

<!-- CHAT BODY -->
<div id="chatBody"
     style="height:320px;
            overflow-y:auto;
            padding:15px;
            background:#f8f9fa;">

    {{-- realtime messages --}}

</div>

<!-- INPUT -->
@if($session->status != 'closed')

<div id="chatInputArea">

    <form id="customerChatForm">

        @csrf

        <div class="d-flex gap-2 align-items-end">

            <div class="flex-grow-1">

                <textarea
                    id="customerMessage"
                    class="form-control"
                    rows="2"
                    placeholder="Type message..."
                    style="resize:none;"></textarea>

            </div>

            <button
                class="btn btn-primary"
                type="submit">

                <i class="bx bx-send"></i>

            </button>

        </div>

    </form>

</div>

@endif


@push('js')

<script>

    const sessionId = {{ $session->id }};

    /*
    |--------------------------------------------------------------------------
    | LOAD CHAT
    |--------------------------------------------------------------------------
    */

    async function loadChat() {

        try {

            // status check
            await fetch(
                `/chat-session/${sessionId}/status`
            );

            // messages
            const response = await fetch(
                `/livechat/${sessionId}/messages`
            );

            const data = await response.json();

            let html = '';

            data.messages.forEach(message => {

                /*
                |--------------------------------------------------------------------------
                | AGENT
                |--------------------------------------------------------------------------
                */

                if(message.sender_type === 'agent') {

                    html += `
                        <div class="d-flex justify-content-start mb-3">

                            <div style="max-width:80%;">

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

                    /*
                    |--------------------------------------------------------------------------
                    | CUSTOMER
                    |--------------------------------------------------------------------------
                    */

                    html += `
                        <div class="d-flex justify-content-end mb-3">

                            <div style="max-width:80%; text-align:right;">

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

            document.getElementById('chatBody').innerHTML = html;

            // auto scroll
            const chatBody = document.getElementById('chatBody');

            chatBody.scrollTop = chatBody.scrollHeight;

            // closed
            if(data.status === 'closed') {

                document.getElementById(
                    'chatInputArea'
                ).innerHTML = `

                    <div class="text-center py-3 border-top">

                        <span class="text-muted d-block mb-2">
                            Chat telah ditutup
                        </span>

                        <a
                            href="{{ route('home') }}"
                            class="btn btn-secondary">

                            Kembali ke Home

                        </a>

                    </div>

                `;
            }

        } catch(error) {

            console.log(error);

        }
    }

    /*
    |--------------------------------------------------------------------------
    | SEND CUSTOMER MESSAGE
    |--------------------------------------------------------------------------
    */

    const customerForm =
        document.getElementById('customerChatForm');

    if(customerForm) {

        customerForm.addEventListener(
            'submit',
            async function(e) {

                e.preventDefault();

                const message =
                    document.getElementById(
                        'customerMessage'
                    ).value;

                if(message.trim() == '') {

                    return;

                }

                try {

                    await fetch(
                        `/livechat/${sessionId}/send`,
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

                    document.getElementById(
                        'customerMessage'
                    ).value = '';

                    loadChat();

                } catch(error) {

                    console.log(error);

                }

            }
        );
    }

    /*
    |--------------------------------------------------------------------------
    | REALTIME
    |--------------------------------------------------------------------------
    */

    loadChat();

    setInterval(loadChat, 5000);

</script>

@endpush