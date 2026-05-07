<div id="chatHeader" class="d-flex justify-content-between align-items-center">
    
    <span>
        Live Chat Support
    </span>

    <small>
        Online
    </small>

</div>

<!-- CHAT BODY -->
<div id="chatBody"
     style="height:320px; overflow-y:auto; padding:10px; background:#f8f8f8;">

    <!-- BOT -->
    <div class="mb-3">
        <div class="bg-light p-2 rounded d-inline-block">
            Halo, ada yang bisa kami bantu?
        </div>
    </div>

    <!-- CUSTOMER -->
    <div class="mb-3 text-end">
        <div class="bg-primary text-white p-2 rounded d-inline-block">
            Saya ingin bertanya.
        </div>
    </div>

</div>

<!-- INPUT -->
<div id="chatInputArea">

    <form action="" method="POST">
        @csrf

        <div class="input-group">

            <input
                type="text"
                class="form-control"
                placeholder="Type message..."
            >

            <button
                class="btn btn-primary"
                type="submit">
                Send
            </button>

        </div>

    </form>

</div>