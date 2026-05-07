@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-lg-12 mb-4">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="mb-1">Live Chat Service</h4>
                        <p class="text-muted mb-0">
                            List customer live chat
                        </p>
                    </div>

                    <span class="badge bg-primary">
                        {{ $sessions->count() }} Chat
                    </span>

                </div>

                <div class="row" id="livechatList">

                    @include('cms.livechat.list')

                </div>


            </div>
        </div>

    </div>

</div>

@endsection

@push('js')

<script>

    async function reloadLivechat() {

        try {

            const response = await fetch(
                `/chat/livechat/reload/list`
            );

            const html = await response.text();

            document.getElementById(
                'livechatList'
            ).innerHTML = html;

        } catch(error) {

            console.log(error);

        }
    }

    setInterval(reloadLivechat, 5000);

</script>

@endpush