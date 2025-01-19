<button class="btn btn-dark d-lg-none position-fixed d-flex start-0 mt-4 ms-2"
        type="button"
        style="z-index: 1050;padding-top: 0px;"
        onclick="toggleSidebar()">
    <i class="bi bi-list">=</i>
</button>

<div class="sidebar px-3 py-4 bg-dark" style="width: 280px;">
    <div class="d-flex align-items-center mb-4 px-2">
        <i class="bi bi-box-seam text-primary fs-4 me-2"></i>
        <h5 class="text-primary mb-0">Market Point</h5>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{route('admin.page.dashboard')}}" class="nav-link {{ request()->routeIs('admin.page.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.page.market') }}" class="nav-link {{ request()->routeIs('market.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam me-2"></i>
                Products
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('questions.index') }}" class="nav-link {{ request()->routeIs('question.*') ? 'active' : '' }}">
                <i class="bi bi-question-circle me-2"></i>
                Quest
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.page.transactions') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin me-2"></i>
                Transactions
            </a>
        </li>
    </ul>

    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
