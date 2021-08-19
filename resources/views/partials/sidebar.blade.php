<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="menu-icon fa fa-dashboard"></i> Dashboard </a>
                </li>
                <li class="{{ (Route::is('admin.projects') || Route::is('page.create')) ? 'active' : '' }}">
                    <a href="{{ route('admin.projects') }}"><i class="menu-icon fa fa fa-product-hunt "></i> Projects </a>
                </li>
                <li class="{{ (Route::is('admin.promoted_projects') || Route::is('page.create')) ? 'active' : '' }}">
                    <a href="{{ route('admin.promoted_projects') }}"><i class="menu-icon fa fa fa-circle "></i> Promoted Project </a>
                </li>
                <li class="{{ (Route::is('admin.ads') || Route::is('page.create')) ? 'active' : '' }}">
                    <a href="{{ route('admin.ads') }}"><i class="menu-icon fa fa fa-adn "></i> Ads </a>
                </li>
                <li class="{{ Route::is('admin.votes') ? 'active' : '' }}">
                    <a href="{{ route('admin.votes') }}"><i class="menu-icon fa fa fa-user "></i> Votes </a>
                </li>
                <li class="{{ (Route::is('pages') || Route::is('page.create')) ? 'active' : '' }}">
                    <a href="{{ route('pages') }}"><i class="menu-icon fa fa-address-book-o "></i> Pages </a>
                </li>
                <li class="{{ Route::is('users') ? 'active' : '' }}">
                    <a href="{{ route('users') }}"><i class="menu-icon fa fa-users"></i> Users</a>
                </li>
                <li class="{{ Route::is('setting') ? 'active' : '' }}">
                    <a href="{{ route('setting') }}"><i class="menu-icon fa fa-cogs"></i> Setting </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
