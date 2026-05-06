<div id="chatHeader" class="text-center">Live Chat Support</div>

<div id="chatContent" class="text-center">
  <strong>Please Enter Your Personal Information to Connect With Us</strong>
</div>

<div class="m-3">
  <form class="mb-1" action="" method="POST">
    @csrf

    <!-- NAME -->
    <div class="mb-2">
      <label for="name" class="form-label">Name</label>
      <input
        type="text"
        class="form-control @error('name') is-invalid @enderror"
        id="name"
        name="name"
        placeholder="Input Your Name"
        required
      />
      @error('name')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
      @enderror
    </div>

    <!-- EMAIL -->
    <div class="mb-2">
      <label for="email" class="form-label">Email</label>
      <input
        type="email"
        class="form-control @error('email') is-invalid @enderror"
        id="email"
        name="email"
        placeholder="Input Your Email"
        required
      />
      @error('email')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
      @enderror
    </div>

    <!-- PHONE -->
    <div class="mb-2">
      <label for="phone" class="form-label">Phone</label>
      <input
        type="text"
        class="form-control @error('phone') is-invalid @enderror"
        id="phone"
        name="phone"
        placeholder="Input Your Phone"
        required
      />
      @error('phone')
        <div class="invalid-feedback d-block">
          {{ $message }}
        </div>
      @enderror
    </div>

    <div class="mb-1">
      <div class="captcha">
        <span class="me-1">{!! captcha_img('inverse') !!}</span>
        <button type="button" class="btn btn-danger reload" id="reload">
          &#x21bb;
        </button>
      </div>
    </div>
    <div class="mb-3">
      <input
        type="text"
        class="form-control @error('captcha') is-invalid @enderror"
        id="captcha"
        name="captcha"
        placeholder="Enter Captcha" required
        />
        @error('captcha')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror
    </div>

    <!-- BUTTON -->
    <div class="mb-3 text-end">
      <button class="btn btn-primary" type="submit">Next</button>
    </div>
  </form>
</div>

<!-- CHAT INPUT (sebaiknya disembunyikan dulu) -->
<div id="chatInputArea" style="display: none;">
  <div class="input-group">
    <input id="chatInput" type="text" class="form-control" placeholder="Ketik pesan..." />
    <button class="btn btn-primary" id="sendBtn">Kirim</button>
  </div>
</div>

@push('js')

<script>
  $('#reload').click(function() {
      $.ajax({
          type: 'GET',
          url: '{{ route('reloadCaptcha') }}',  // Gunakan route yang dinamakan di sini
          success: function(data) {
              $('.captcha span').html(data.captcha);
          }
      });
  });
</script>
    
@endpush