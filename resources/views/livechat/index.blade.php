@if(!isset($session))

    @include('livechat.register')

@elseif($session->status == 'waiting')

    @include('livechat.waiting')

@elseif($session->status == 'closed')

    @include('livechat.closed')

@elseif($session->status == 'active')

    @include('livechat.room')

@endif