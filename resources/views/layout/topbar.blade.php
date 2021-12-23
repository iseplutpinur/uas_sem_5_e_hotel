<nav class="navbar navbar-expand-lg navbar-light bg-light p-3 d-none d-md-block d-lg-block d-xl-block">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">e-hotel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <div class="me-auto"></div>
            <span class="navbar-text">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::user())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('active-transaction') }}">Active Transaction</a></li>
                                <li><a class="dropdown-item" href="{{ route('transaction-history') }}">Transaction History</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a role="button" class="dropdown-item btn-logout">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a role="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                        </li>
                    @endif
                </ul>
            </span>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand navbar-light bg-light fixed-bottom d-md-none d-lg-none d-xl-none">
    <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}"><i class="fas fa-lg fa-home"></i></a>
        </li>
        @if (Auth::user())
            <li class="nav-item">
                <div class="dropdown dropup">
                    <a role="button" class="nav-link dropdown-toggle" id="dropdownMenuProfile" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-lg fa-user-circle"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('active-transaction') }}">Active Transaction</a></li>
                        <li><a class="dropdown-item" href="{{ route('transaction-history') }}">Transaction History</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a role="button" class="dropdown-item btn-logout">Logout</a></li>
                    </ul>
                </div>
            </li>
        @else
            <li class="nav-item">
                <div class="dropdown dropup">
                    <a role="button" class="nav-link dropdown-toggle" id="dropdownMenuProfile" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-lg fa-user-circle"></i></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                        <li class="nav-item">
                            <a role="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        </li>
                        <li class="nav-item">
                            <a role="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>
