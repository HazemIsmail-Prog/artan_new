<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        {{ config('app.name', 'Laravel') }}
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        @if (in_array(auth()->user()->type,['admin','user']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['dashboard']) ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type,['admin']))
            <li class="nav-title">Settings</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['users.*']) ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Users
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type,['admin','user','tech']))
            <li class="nav-title">Orders</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['orders.*']) ? 'active' : '' }}" href="{{ route('orders.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Orders
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type,['admin','accountant']))
            <li class="nav-title">Accounting</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs(['accounts.*']) ? 'active' : '' }}" href="{{ route('accounts.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->route('type') == 'jv' ? 'active' : '' }}" href="{{ route('vouchers.index',['type'=>'jv']) }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Journal Vouchers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->route('type') == 'bp' ? 'active' : '' }}" href="{{ route('vouchers.index',['type'=>'bp']) }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Bank Payments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->route('type') == 'br' ? 'active' : '' }}" href="{{ route('vouchers.index',['type'=>'br']) }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                    </svg> Bank Receipts
                </a>
            </li>
        @endif


        <li class="nav-title">Reports</li>

        @if (in_array(auth()->user()->type,['admin','accountant']))
            <li class="nav-group">
                <a class="nav-link nav-group-toggle" href="#">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-star') }}"></use>
                    </svg>
                    Accounting
                </a>
                <ul class="nav-group-items">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['account_statement.*']) ? 'active' : '' }}" href="{{ route('account_statement.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                            </svg> Account Statement
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['bank_book.*']) ? 'active' : '' }}" href="{{ route('bank_book.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                            </svg> Bank Book
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['trial_balance.*']) ? 'active' : '' }}" href="{{ route('trial_balance.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                            </svg> Trial Balance
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['balance_sheet.*']) ? 'active' : '' }}" href="{{ route('balance_sheet.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                            </svg> Balance Sheet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['profit_loss.*']) ? 'active' : '' }}" href="{{ route('profit_loss.index') }}">
                            <svg class="nav-icon">
                                <use xlink:href="{{ asset('theme/vendors/@coreui/icons/svg/free.svg#cil-chart-pie') }}"></use>
                            </svg> Profit & Loss
                        </a>
                    </li>
                </ul>
            </li>
        @endif

    </ul>
</div>
