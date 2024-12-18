@if (Auth::user()->roles()->where('name', 'admin')->exists())
    <!-- Admin menu -->
    <div class="col-auto sidebar">
        <a href="{{ route('admin.dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Home"><i class="fa-solid fa-house-chimney"></i></a>
        <a href="{{ route('admin.users') }}" class="{{ Request::is('admin/users') || Request::is('admin/treasurer/*') || Request::is('admin/donator/*') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Users"><i class="fa-solid fa-users"></i></a>
        <a href="{{ route('admin.funds') }}" class="{{ Request::is('admin/funds') || Request::is('admin/fund/*') || Request::is('admin/general_fund') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Funds"><i class="fa-solid fa-hand-holding-dollar"></i></a>
        <a href="{{ route('admin.transaction') }}" class="{{ Request::is('admin/transaction') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Transactions History"><i class="fa-solid fa-clock-rotate-left"></i></a>
        <a href="{{ route('profile.edit') }}" class="{{ Request::is('profile') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Profile"><i class="fa-solid fa-user"></i></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" data-bs-toggle="tooltip" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        </form>
    </div>
@elseif(Auth::user()->roles()->where('name', 'treasurer')->exists())
    <!-- Treasurer menu -->
    <div class="col-auto sidebar">
        <a href="{{ route('treasurer.dashboard') }}" class="{{ Request::is('treasurer/dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Home"><i class="fa-solid fa-house-chimney"></i></a>
        <a href="{{ route('treasurer.funds') }}" class="{{ Request::is('treasurer/funds') || Request::is('treasurer/fund/*') || Request::is('treasurer/edit_fund/*') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Funds"><i class="fa-solid fa-hand-holding-dollar"></i></a>
        <a href="{{ route('treasurer.transaction') }}" class="{{ Request::is('treasurer/transaction') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Transactions History"><i class="fa-solid fa-clock-rotate-left"></i></a>
        <a href="{{ route('profile.edit') }}" class="{{ Request::is('profile') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Profile"><i class="fa-solid fa-user"></i></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" data-bs-toggle="tooltip" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        </form>
    </div>
@else
    <!-- Donator menu -->
    <div class="col-auto sidebar">
        <a href="{{ route('donator.dashboard') }}" class="{{ Request::is('donator/dashboard') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Home"><i class="fa-solid fa-house-chimney"></i></a>
        <a href="{{ route('donator.scan_qr') }}" class="{{ Request::is('donator/scan_qr') || Request::is('funds/fund_details/*') || Request::is('general_funds/fund_details/*') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Scan QR Code"><i class="fa-solid fa-qrcode"></i></a>
        <a href="{{ route('donator.transaction') }}" class="{{ Request::is('donator/transaction') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Transaction History"><i class="fa-solid fa-clock-rotate-left"></i></a>
        <a href="{{ route('profile.edit') }}" class="{{ Request::is('profile') ? 'active' : '' }}" data-bs-toggle="tooltip" title="Profile"><i class="fa-solid fa-user"></i></a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" data-bs-toggle="tooltip" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
        </form>
    </div>
@endif