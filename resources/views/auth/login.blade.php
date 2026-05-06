<div class="card-body">
    <!-- Logo -->
    <div class="app-brand justify-content-center">
      <a href="#" class="app-brand-link gap-2">
        <span class="app-brand-logo demo" style="width: 50px;height:50px">
          <img src="{{ asset('vads.png') }}" class="img-fluid rounded-circle h-100" alt="default">
        </span>
      </a>
    </div>
    <!-- /Logo -->
    <p class="mb-4">Sig In to Your Account</p>

    <form class="mb-3" action="{{ route('login.authenticate') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="login" class="form-label">User Name or Email</label>
        <input
          type="text"
          class="form-control @error('login') is-invalid @enderror"
          id="login"
          name="login"
          placeholder="Enter your username or email" required
          autofocus />
          @error('login')
            <div class="invalid-feedback d-block">
              {{ $message }}
            </div>
          @enderror
      </div>
      
      <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="password">Password</label>
        </div>
        <div class="input-group input-group-merge">
          <input
            type="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            name="password"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="password" required />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        @error('password')
          <div class="invalid-feedback d-block">
            {{ $message }}
          </div>
        @enderror
      </div>
      
      <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
      </div>
  </form>
</div>