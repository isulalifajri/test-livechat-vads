<div id="chatHeader" class="text-center">
    Live Chat Support
</div>

<div class="p-3 text-center">

    <div class="alert alert-primary small">
        Okay, take a deep breath and release!
    </div>

    <div class="my-4">
        <i class="bx bx-coffee-togo"
           style="font-size:90px;color:#696cff;">
        </i>
    </div>

    <div class="alert alert-info small">
        We're looking for the best customer representative for you.
    </div>

    <div class="mt-3">
        <h4 id="countdown">03:00</h4>
        <small class="text-muted">
            Please wait a moment...
        </small>
    </div>

</div>

@push('js')
<script>

    const queueStart = new Date("{{ $session->queue_start }}").getTime();
    const endTime = queueStart + (3 * 60 * 1000);

    const countdown = document.getElementById('countdown');

    function updateCountdown() {

        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {

            countdown.innerHTML = "00:00";
            return;

        }

        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.innerHTML =
            String(minutes).padStart(2, '0') + ":" +
            String(seconds).padStart(2, '0');
    }

    updateCountdown();

    setInterval(updateCountdown, 1000);

</script>

{{-- fetch  --}}
<script>
    const sessionId = {{ $session->id }};

    async function checkStatus() {

        try {

            const response = await fetch(`/chat-session/${sessionId}/status`);
            const data = await response.json();

            // kalau agent sudah connect
            if (data.status === 'active') {

                window.location.reload();

            }

            // kalau timeout / ditutup
            if (data.status === 'closed') {

                window.location.reload();

            }

        } catch (error) {

            console.log(error);

        }
    }

    // cek tiap 5 detik
    setInterval(checkStatus, 5000);
</script>
@endpush