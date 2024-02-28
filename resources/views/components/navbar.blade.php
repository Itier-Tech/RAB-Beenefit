<nav class="navbar">
    <div class="nav-elem-container">
        <button class="navbar-toggler" id="navbar-toggler" onclick="open_sidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse" id="navbarSupportedContent">
            <!-- Search Bar -->
            <form class="form-inline my-2 my-lg-0" action="/project" id="search-form" method="GET">
                <input type="text" class="searchTerm" name="searchTerm" placeholder="Cari proyek">
                <button class="btn src-btn" type="submit">
                    <img src="/images/search-icon.png" alt="search" class="logo"></img>
                </button>
            </form>

            <!-- Divider -->
            <span class="navbar-text mx-3">|</span>

            <!-- User Profile -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown">
                        <img src="{{ asset(Auth::user()->profpic ? 'storage/' . Auth::user()->profpic : '/images/profpic-icon.png') }}" alt="Profile Picture" class="rounded-circle profile-picture">
                        <span style="margin-left: 0.4rem; font-weight: 700; cursor: default;">{{ Auth::user()->full_name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/userUpdate">Profile</a>
                        <div class="dropdown-divider"></div>
                        <!-- Logout Form -->
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
