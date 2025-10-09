<nav style="background:#ffffff;border-bottom:1px solid #E5E7EB;padding:0 16px">
    <div style="max-width:1100px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;height:64px">
        <div style="display:flex;align-items:center;gap:14px">
            <a href="{{ route('dashboard') }}" style="text-decoration:none;color:#111827;font-weight:800">MyFRS</a>
            <a href="{{ route('dashboard') }}" style="text-decoration:none;color:#6B7280">Dashboard</a>
        </div>
        <div>
            <span style="margin-right:12px;color:#6B7280">{{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" style="text-decoration:none;color:#6B7280;margin-right:12px">Profile</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" style="background:#ef4444;color:#fff;border:none;border-radius:8px;padding:8px 12px;cursor:pointer">Logout</button>
            </form>
        </div>
    </div>
</nav>

