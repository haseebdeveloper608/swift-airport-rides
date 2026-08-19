<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login · Swift Ride Taxis</title>
  <meta name="author" content="Haseeb Naeem">

  <!-- Font Awesome 6 (free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Inter font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Inter", system-ui, -apple-system, sans-serif;
      background: radial-gradient(circle at 20% 30%, #f0f5fe, #e6edfa);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      color: #0C1B36;
    }

    /* glass‑morphism card — deep blue #0C1B36 accent */
    .login-glass {
      width: 100%;
      max-width: 1000px;
      display: flex;
      border-radius: 2.5rem;
      background: rgba(255, 255, 255, 0.70);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      box-shadow: 0 25px 45px -8px rgba(12, 27, 54, 0.20), 0 8px 20px -6px rgba(0, 0, 0, 0.02);
      border: 1px solid rgba(255, 255, 255, 0.5);
      overflow: hidden;
      transition: all 0.3s ease;
    }

    /* left side — brand panel with #0C1B36 base */
    .brand-panel {
      flex: 1 1 45%;
      background: linear-gradient(145deg, #0C1B36, #1a2f4f);
      padding: 3rem 2rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: white;
      position: relative;
      isolation: isolate;
    }

    .brand-panel::after {
      content: '';
      position: absolute;
      inset: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.07"><path fill="white" d="M20 70 L30 40 L50 30 L70 40 L80 70 L60 85 L40 85 Z"/><circle cx="30" cy="25" r="6"/><circle cx="70" cy="25" r="6"/></svg>');
      background-size: 130px;
      background-repeat: repeat;
      z-index: 0;
    }

    .brand-content {
      position: relative;
      z-index: 2;
    }

    .brand-icon {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(8px);
      width: 70px;
      height: 70px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1.5px solid rgba(255,255,255,0.25);
      margin-bottom: 2.2rem;
    }

    .brand-icon i {
      font-size: 2.6rem;
      color: white;
      filter: drop-shadow(0 6px 10px rgba(0,0,0,0.1));
    }

    .brand-panel h1 {
      font-size: 2.2rem;
      font-weight: 700;
      letter-spacing: -1px;
      line-height: 1.2;
      margin-bottom: 1rem;
    }

    .brand-tagline {
      font-size: 1.1rem;
      opacity: 0.85;
      font-weight: 400;
      margin-bottom: 2.8rem;
      max-width: 24ch;
    }

    .testimonial {
      border-left: 4px solid rgba(255,255,255,0.4);
      padding-left: 1.2rem;
      margin-top: 2rem;
    }

    .testimonial p {
      font-size: 1rem;
      line-height: 1.5;
      font-style: italic;
      font-weight: 400;
      opacity: 0.9;
    }

    .testimonial span {
      display: block;
      margin-top: 0.5rem;
      font-size: 0.85rem;
      opacity: 0.8;
      font-weight: 300;
    }

    /* right side — login form */
    .form-panel {
      flex: 1 1 55%;
      padding: 3rem 2.8rem;
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(8px);
    }

    .form-header {
      margin-bottom: 2rem;
    }

    .form-header h2 {
      font-size: 1.9rem;
      font-weight: 650;
      letter-spacing: -0.03em;
      color: #0C1B36;
      margin-bottom: 0.4rem;
    }

    .form-header p {
      color: #2f405b;
      font-size: 0.95rem;
      font-weight: 400;
      display: flex;
      align-items: center;
      gap: 0.3rem;
    }

    .form-header p i {
      color: #0C1B36;
      font-size: 0.8rem;
    }

    /* social connect – minimal outline with dark accent */
    .social-connect {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      width: 100%;
      background: white;
      border: 1px solid #dce3ed;
      border-radius: 60px;
      padding: 0.6rem 0.6rem 0.6rem 1.2rem;
      transition: all 0.2s;
      text-decoration: none;
      color: #0C1B36;
      font-weight: 550;
      font-size: 0.95rem;
      margin: 1.8rem 0 1.4rem;
      box-shadow: 0 2px 6px rgba(12,27,54,0.02);
    }

    .social-connect i {
      background: #0C1B3610;
      padding: 0.45rem;
      border-radius: 50%;
      color: #0C1B36;
      font-size: 1rem;
    }

    .social-connect span {
      flex: 1;
      text-align: left;
    }

    .social-connect:hover {
      background: #f2f6fe;
      border-color: #0C1B3670;
      transform: scale(1.01);
    }

    .divider {
      display: flex;
      align-items: center;
      color: #5a6f88;
      font-size: 0.8rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 1.8rem 0 1.8rem;
      gap: 0.5rem;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background: linear-gradient(to right, transparent, #c8d3e0, transparent);
    }

    /* form elements — with #0C1B36 accent */
    .input-group {
      margin-bottom: 1.35rem;
    }

    .input-label {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.4rem;
    }

    .input-label label {
      font-size: 0.85rem;
      font-weight: 600;
      color: #0C1B36;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    .input-field {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-field i {
      position: absolute;
      left: 1rem;
      color: #6a7f99;
      font-size: 1rem;
      transition: color 0.15s;
    }

    .input-field .toggle-pass {
      left: auto;
      right: 1rem;
      cursor: pointer;
      color: #5a6f88;
      z-index: 3;
    }

    .input-field input {
      width: 100%;
      padding: 0.9rem 1rem 0.9rem 2.7rem;
      border: 1.5px solid #e2e9f2;
      border-radius: 18px;
      font-size: 0.95rem;
      background: white;
      transition: all 0.2s;
      font-weight: 450;
      color: #0C1B36;
    }

    .input-field input:focus {
      border-color: #0C1B36;
      box-shadow: 0 0 0 4px rgba(12, 27, 54, 0.08);
      outline: none;
    }

    .input-field:focus-within i {
      color: #0C1B36;
    }

    .forgot-link {
      font-size: 0.75rem;
      font-weight: 550;
      color: #0C1B36;
      text-decoration: none;
      padding: 0.2rem 0.4rem;
      border-radius: 40px;
      transition: background 0.1s;
    }

    .forgot-link:hover {
      background: rgba(12, 27, 54, 0.06);
      text-decoration: none;
    }

    /* checkbox — accent #0C1B36 */
    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      margin: 1.5rem 0 1.8rem;
    }

    .checkbox-group input[type="checkbox"] {
      width: 1.1rem;
      height: 1.1rem;
      accent-color: #0C1B36;
      border-radius: 6px;
      margin: 0;
      cursor: pointer;
    }

    .checkbox-group label {
      font-size: 0.9rem;
      color: #1d2f47;
      font-weight: 450;
    }

    /* primary button — deep blue #0C1B36 */
    .btn-signin {
      background: #0C1B36;
      border: none;
      border-radius: 40px;
      padding: 0.9rem 1.8rem;
      font-weight: 650;
      font-size: 1rem;
      color: white;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      transition: all 0.25s;
      border: 1px solid rgba(255,255,255,0.15);
      box-shadow: 0 8px 18px -6px rgba(12, 27, 54, 0.5);
      cursor: pointer;
    }

    .btn-signin i {
      font-size: 0.9rem;
      transition: transform 0.15s;
    }

    .btn-signin:hover {
      background: #1a2f4f;
      transform: scale(1.02);
      box-shadow: 0 12px 22px -8px #0C1B36CC;
    }

    .btn-signin:hover i {
      transform: translateX(4px);
    }

    .back-home {
      text-align: center;
      margin-top: 2rem;
      font-size: 0.85rem;
      color: #2f405b;
    }

    .back-home a {
      color: #0C1B36;
      font-weight: 600;
      text-decoration: none;
      border-bottom: 1.5px solid transparent;
      transition: border 0.15s;
    }

    .back-home a:hover {
      border-bottom-color: #0C1B36;
      color: #0C1B36;
    }

    /* responsive */
    @media (max-width: 820px) {
      .login-glass {
        flex-direction: column;
        max-width: 500px;
        border-radius: 2rem;
      }
      .brand-panel {
        padding: 2rem 1.8rem;
      }
      .form-panel {
        padding: 2.2rem 2rem;
      }
    }

    @media (max-width: 450px) {
      body { padding: 0.75rem; }
      .form-panel { padding: 1.8rem 1.2rem; }
      .brand-panel h1 { font-size: 1.8rem; }
    }

    .fade-elem {
      animation: fadeSlide 0.4s ease-out;
    }
    @keyframes fadeSlide {
      0% { opacity: 0.5; transform: translateY(6px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="login-glass">
    <!-- LEFT: brand panel with Swift Ride Taxis identity -->
    <div class="brand-panel">
      <div class="brand-content">
        <div class="brand-icon fade-elem">
          <i class="fas fa-plane-departure"></i>
        </div>
        <h1 class="fade-elem">Swift Ride<br>Taxis.</h1>
        <p class="brand-tagline fade-elem">Seamless transfers · luxury comfort.</p>
        <div class="testimonial fade-elem">
          <p>“Punctual, professional, and effortless. The best airport service in the UK.”</p>
          <span>— Eleanor Vance, frequent flyer</span>
        </div>
      </div>
      <div style="position: relative; z-index: 2; font-size: 0.8rem; opacity: 0.7; margin-top: 1.5rem;">
        <i class="fas fa-star"></i> 4.98 · trusted by 8k+ travellers
      </div>
    </div>

    <!-- RIGHT: Login panel -->
    <div class="form-panel">
      <div class="form-header fade-elem">
        <h2>Access Account</h2>
        <p><i class="fas fa-circle-check"></i> manage your rides</p>
      </div>

      <div class="divider fade-elem">
        <span class="divider-line"></span>
        <span>or sign in with email</span>
        <span class="divider-line"></span>
      </div>

      <!-- Laravel form – action preserved (placeholder) -->
      <form action="{{ route('login') }}" method="POST" style="animation: fadeSlide 0.5s ease-out;">
        @csrf
        
        <!-- email group -->
        <div class="input-group fade-elem">
          <div class="input-label">
            <label for="email">Email</label>
            <a href="#" class="forgot-link" style="opacity: 0; pointer-events: none;">.</a>
          </div>
          <div class="input-field">
            <i class="far fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="book@[EMAIL_ADDRESS]" required>
          </div>
        </div>

        <!-- password group -->
        <div class="input-group fade-elem">
          <div class="input-label">
            <label for="password">Password</label>
            <a href="#" class="forgot-link">forgot?</a>
          </div>
          <div class="input-field">
            <i class="fas fa-lock-keyhole"></i>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
            <i class="fas fa-eye-slash toggle-pass"></i>
          </div>
        </div>

        <!-- remember me -->
        <div class="checkbox-group fade-elem">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Keep me signed in — 30 days</label>
        </div>

        <!-- submit -->
        <button type="submit" class="btn-signin fade-elem">
          <span>Sign in to dashboard</span>
          <i class="fas fa-arrow-right"></i>
        </button>
      </form>

      <!-- home link -->
      <p class="back-home fade-elem">
        <i class="fas fa-chevron-left" style="font-size: 0.65rem; color: #5a6f88;"></i>
        <a href="/">return to airportrides.uk</a>
      </p>
    </div>
  </div>

  <!-- password toggle -->
  <script>
    (function() {
      const toggleEye = document.querySelector('.toggle-pass');
      if (toggleEye) {
        toggleEye.addEventListener('click', function(e) {
          e.preventDefault();
          const passwordField = document.getElementById('password');
          const isLock = passwordField.type === 'password';
          passwordField.type = isLock ? 'text' : 'password';
          this.classList.remove('fa-eye-slash', 'fa-eye');
          this.classList.add(isLock ? 'fa-eye' : 'fa-eye-slash');
        });
      }
    })();
  </script>
</body>
</html>