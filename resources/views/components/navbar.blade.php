<nav class="navbar">
    <div class="container">
        <button class="navbar-toggler" id="navbar-toggler" onclick="open_sidebar()">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse" id="navbarSupportedContent">
            <!-- Search Bar -->
            <form class="form-inline my-2 my-lg-0" id="search-form">
                <input type="text" class="searchTerm" placeholder="Search">
                <button class="btn src-btn" type="submit">
                    <img src="/images/search-icon.png" alt="search" class="logo"></img>
                </button>
            </form>

            <!-- Divider -->
            <span class="navbar-text mx-3">|</span>

            <!-- User Profile -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" >
                        <img src="/images/profpic-icon.png" alt="Profile Picture" class="rounded-circle profile-picture">
                        <span style="margin-left: 6px; font-weight: 700; cursor: default;">Nama User</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
