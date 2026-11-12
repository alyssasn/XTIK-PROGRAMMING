@if (session('success'))
    <div style="background: #e6f9ec; color: #1e7e34; border-left: 4px solid #28a745; padding: 12px 18px; margin: 16px 0; border-radius: 6px; display: flex; align-items: center; justify-content: space-between; font-weight: 500; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
        <span><i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i> {{ session('success') }}</span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:#1e7e34; font-size:18px; cursor:pointer; line-height:1;">&times;</button>
    </div>
@endif

@if (session('error') || $errors->any())
    <div style="background: #fdecea; color: #b02a37; border-left: 4px solid #dc3545; padding: 12px 18px; margin: 16px 0; border-radius: 6px; display: flex; align-items: center; justify-content: space-between; font-weight: 500; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
        <span><i class="fa-solid fa-triangle-exclamation" style="margin-right: 8px;"></i> {{ session('error') ?? $errors->first() }}</span>
        <button type="button" onclick="this.parentElement.remove()" style="background:none; border:none; color:#b02a37; font-size:18px; cursor:pointer; line-height:1;">&times;</button>
    </div>
@endif
