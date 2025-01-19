<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-shop me-2"></i>
            Market Point
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.page.dashboard') ? 'active' : '' }}"
                       href="{{ route('user.page.dashboard') }}">
                        <i class="bi bi-question-circle me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('question.index') ? 'active' : '' }}"
                       href="{{ route('user.page.index') }}">
                        <i class="bi bi-question-circle me-1"></i>Quest
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.page.market') ? 'active' : '' }}"
                       href="{{ route('user.page.market') }}">
                        <i class="bi bi-shop me-1"></i>Market
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.page.transaction') ? 'active' : '' }}"
                       href="{{ route('user.page.transaction.index') }}">
                        <i class="bi bi-receipt me-1"></i>Transactions
                    </a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-light" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Login') }}
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-light" href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>{{ __('Register') }}
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                           id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                 class="rounded-circle me-2" alt="Profile" width="32" height="32">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- Profile -->
                            <li>
                                <a class="dropdown-item" href="{{ route('user.page.profile.show') }}">
                                    <i class="bi bi-person me-1"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <!-- Logout -->
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-1"></i>{{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
