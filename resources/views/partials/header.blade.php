<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a href="{{ route('home') }}"><figure class="">
                <img style="height: 25px" src="{{ url('storage' . $logoLink) }}" alt="logo">
            </figure></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="{{ asset('assets/images/admin.jpg') }}" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>
                    <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  <i class="fa fa-power -off"></i>
                                  {{ __('Logout') }}
                                </a>  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                </div>
            </div>

        </div>
    </div>
</header>
