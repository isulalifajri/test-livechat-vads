<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>{{ $title ?? "Vads Indonesia LiveChat" }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css')}}" />

  <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>
  <script src="{{ asset('assets/js/config.js')}}"></script>

  <!-- CUSTOM CSS CHAT -->
  <style>
    #chatToggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background: #696cff;
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 9999;
    }

    #chatBox {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 320px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      z-index: 9999;

      opacity: 0;
      transform: translateY(20px);
      pointer-events: none;
      transition: all 0.3s ease;
    }

    #chatBox.show {
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }

    #chatHeader {
      background: #696cff;
      color: white;
      padding: 12px;
      font-weight: 600;
    }

    #chatContent {
      padding: 10px;
      overflow-y: auto;
      font-size: 14px;
    }

    #chatInputArea {
      padding: 10px;
      border-top: 1px solid #eee;
    }
  </style>

</head>

<body>

  <!-- LOGIN -->
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">
            @include('auth.login')
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CHAT BUTTON -->
  <div id="chatToggle">
    <i class="bx bx-message-dots" style="font-size: 24px;"></i>
  </div>

  <!-- CHAT BOX -->
  <div id="chatBox">
     @include('auth.register')
  </div>

  <!-- JS -->
  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js')}}"></script>
  <script src="{{ asset('assets/js/main.js')}}"></script>

  <!-- CHAT SCRIPT -->
  <script>
    const toggle = document.getElementById("chatToggle");
    const box = document.getElementById("chatBox");
    const input = document.getElementById("chatInput");
    const content = document.getElementById("chatContent");
    const sendBtn = document.getElementById("sendBtn");

    toggle.addEventListener("click", () => {
      box.classList.toggle("show");
    });

    sendBtn.addEventListener("click", sendMessage);

    input.addEventListener("keypress", function (e) {
      if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {
      const msg = input.value.trim();
      if (!msg) return;

      content.innerHTML += `<div style="text-align:right; margin:5px 0;">${msg}</div>`;
      input.value = "";

      setTimeout(() => {
        content.innerHTML += `<div style="margin:5px 0;">Terima kasih, pesan diterima 👍</div>`;
        content.scrollTop = content.scrollHeight;
      }, 500);
    }
  </script>

  @stack('js')

</body>
</html>