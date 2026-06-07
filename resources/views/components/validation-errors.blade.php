@if ($errors->any())
<div {{ $attributes }}>
    <div style="background:#fff1f2;border:1px solid #fecdd3;border-radius:12px;padding:14px 18px;display:flex;align-items:flex-start;gap:12px;">
        <div style="width:34px;height:34px;background:#fee2e5;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:1px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f43f5e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        </div>
        <div>
            <p style="font-family:'Nunito',sans-serif;font-weight:800;color:#be123c;margin:0 0 6px;font-size:.875rem;">
                Identifiants incorrects
            </p>
            <ul style="margin:0;padding:0;list-style:none;">
                @foreach ($errors->all() as $error)
                <li style="font-size:.82rem;color:#e11d48;display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                    <span style="width:4px;height:4px;background:#f43f5e;border-radius:50%;display:inline-block;flex-shrink:0;"></span>
                    {{ $error }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
