    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 d-flex flex-column justify-content-between" style="height: 100%">
        <ul class="nav flex-column">
            @if (auth()->user()->account_type === "admin")
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                <span>Administrator</span>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/members*') ? 'active' : '' }}" href="/dashboard/members">
                <span data-feather="users" class="align-text-bottom"></span>
                Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/bibliographies*') ? 'active' : '' }}" href="/dashboard/bibliographies">
                <span data-feather="book-open" class="align-text-bottom"></span>
                Bibliographies
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/authors*') ? 'active' : '' }}" href="/dashboard/authors">
                <span data-feather="user-check" class="align-text-bottom"></span>
                Authors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/publishers*') ? 'active' : '' }}" href="/dashboard/publishers">
                <span data-feather="trello" class="align-text-bottom"></span>
                Publishers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
                <span data-feather="grid" class="align-text-bottom"></span>
                Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/transactions*') ? 'active' : '' }}" href="/dashboard/transactions">
                <span data-feather="list" class="align-text-bottom"></span>
                Transactions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/requests*') ? 'active' : '' }}" href="/dashboard/requests">
                <span data-feather="send" class="align-text-bottom"></span>
                Request
                </a>
            </li>
            @else
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
                <span>Member</span>
            </h6>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/profile*') ? 'active' : '' }}" aria-current="page" href="/dashboard/profile/{{ auth()->user()->username }}">
                <span data-feather="user" class="align-text-bottom"></span>
                Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/change-password*') ? 'active' : '' }}" aria-current="page" href="/dashboard/change-password">
                <span data-feather="lock" class="align-text-bottom"></span>
                Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/transactions*') ? 'active' : '' }}" aria-current="page" href="/dashboard/transactions/{{ auth()->user()->username }}">
                <span data-feather="list" class="align-text-bottom"></span>
                Transactions
                </a>
            </li>
            @endif
        </ul>
        <ul class="nav flex-column justify-content-end mb-4" style="heigth: 100%">
            <hr>
            <li class="nav-item">
                <a href="/home" class="nav-link"><span data-feather="external-link"></span> Back</a>
            </li>
            <li class="nav-item">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-light"><span data-feather="log-out"></span> Logout</button>
                </form>
            </li>
        </ul>

      </div>
    </nav>
