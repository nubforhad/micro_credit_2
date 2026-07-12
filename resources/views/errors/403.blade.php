 @extends('layouts.app')

@section('content')
<style>
    .error-403-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .error-403-card {
        text-align: center;
        max-width: 500px;
        width: 100%;
    }

    .error-403-icon {
        width: 130px;
        height: 130px;
        margin: 0 auto 25px;
        background: linear-gradient(135deg, #f43f5e, #fb923c);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 15px 35px rgba(244, 63, 94, 0.35);
        animation: pulse-403 2.2s infinite;
    }

    .error-403-icon i {
        font-size: 60px;
        color: #fff;
    }

    @keyframes pulse-403 {
        0% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0.4); }
        70% { box-shadow: 0 0 0 25px rgba(244, 63, 94, 0); }
        100% { box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
    }

    .error-403-code {
        font-size: 100px;
        font-weight: 800;
        line-height: 1;
        background: linear-gradient(135deg, #1e293b, #f43f5e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .error-403-title {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .error-403-desc {
        color: #64748b;
        font-size: 15px;
        margin-bottom: 30px;
    }

    .error-403-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 30px;
        background: linear-gradient(135deg, #1e293b, #334155);
        color: #fff;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: 0.3s ease;
        box-shadow: 0 8px 20px rgba(30, 41, 59, 0.25);
    }

    .error-403-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(30, 41, 59, 0.35);
        color: #fff;
    }
</style>

<div class="error-403-wrapper">
    <div class="error-403-card">
        <div class="error-403-icon">
            <i class="bx bx-lock-alt"></i>
        </div>

        <div class="error-403-code">403</div>

        <h4 class="error-403-title">Access Denied</h4>

        <p class="error-403-desc">
            দুঃখিত, এই পেইজটি access করার permission আপনার নেই। <br>
            আপনার Admin এর সাথে যোগাযোগ করুন।
        </p>

        <a href="{{ route('dashboard') }}" class="error-403-btn">
            <i class="bx bx-arrow-back"></i>
            Back to Dashboard
        </a>
    </div>
</div>
@endsection