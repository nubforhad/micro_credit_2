<x-guest-layout>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap');

        .vault-wrap {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(120% 140% at 20% -10%, #16332C 0%, #0E211C 55%, #0A1815 100%);
            border-radius: 20px;
            padding: 2.75rem 2.25rem 2.25rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px -20px rgba(0,0,0,0.5);
        }
        .vault-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(135deg, rgba(176,141,87,0.04) 0px, rgba(176,141,87,0.04) 1px, transparent 1px, transparent 12px);
            pointer-events: none;
        }
        .vault-seal {
            width: 46px; height: 46px;
            border-radius: 50%;
            border: 1.5px solid #B08D57;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 1.25rem;
            background: rgba(176,141,87,0.06);
        }
        .vault-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            letter-spacing: 0.22em;
            color: #B08D57;
            text-transform: uppercase;
        }
        .vault-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 1.85rem;
            color: #F4EFE3;
            margin-top: 0.35rem;
        }
        .vault-sub {
            color: #9CB3A9;
            font-size: 0.875rem;
            margin-top: 0.35rem;
        }
        .vault-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #B7C9BF;
        }
        .vault-input {
            background: rgba(255,255,255,0.04) !important;
            border: 1px solid rgba(176,141,87,0.35) !important;
            color: #F4EFE3 !important;
            border-radius: 10px !important;
            padding: 0.65rem 0.85rem !important;
            transition: border-color .2s, box-shadow .2s;
        }
        .vault-input:focus {
            border-color: #B08D57 !important;
            box-shadow: 0 0 0 3px rgba(176,141,87,0.18) !important;
        }
        .vault-input::placeholder { color: #6B8578; }
        .vault-remember {
            accent-color: #B08D57;
        }
        .vault-forgot {
            color: #9CB3A9 !important;
            text-decoration: none !important;
            font-size: 0.8rem;
            border-bottom: 1px dotted rgba(156,179,169,0.5);
        }
        .vault-forgot:hover { color: #F4EFE3 !important; }
        .vault-btn {
            background: linear-gradient(135deg, #C9A227, #B08D57) !important;
            color: #16221C !important;
            font-weight: 600 !important;
            border-radius: 10px !important;
            padding: 0.7rem 1.6rem !important;
            border: none !important;
            box-shadow: 0 8px 20px -6px rgba(176,141,87,0.55);
            transition: transform .15s ease, box-shadow .15s ease;
        }
        .vault-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 26px -6px rgba(176,141,87,0.65);
        }
    </style>

    <div class="vault-wrap">
        <div class="vault-seal">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="5" y="10" width="14" height="10" rx="2" stroke="#B08D57" stroke-width="1.4"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="#B08D57" stroke-width="1.4"/>
                <circle cx="12" cy="14.5" r="1.4" fill="#B08D57"/>
            </svg>
        </div>
        <p class="vault-eyebrow">Secure Access</p>
        <h1 class="vault-title">Welcome back</h1>
        <p class="vault-sub">Sign in to continue to your account.</p>

        <!-- Session Status -->
        <x-auth-session-status class="mt-5 text-sm text-[#C9A227]" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="mt-7 space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="vault-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       autocomplete="username"
                       class="vault-input block mt-2 w-full text-sm focus:outline-none">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#E08A7D]" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="vault-label">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="vault-input block mt-2 w-full text-sm focus:outline-none">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#E08A7D]" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="vault-remember rounded border-gray-500" name="remember">
                    <span class="ms-2 text-sm text-[#9CB3A9]">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="vault-forgot" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center justify-end pt-2">
                <button type="submit" class="vault-btn">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>