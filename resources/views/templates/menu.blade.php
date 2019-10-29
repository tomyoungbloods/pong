<!-- Sidebar Menu -->
<nav class="sidebar-nav">
    <!-- Admin Menu -->
    <ul class="nav in side-menu">
        @auth
            <li class="current-page menu-item-has-children"><a href="{{ route('filter.new') }}"><i class="list-icon feather feather-menu"></i> <span class="hide-menu">Ranglijst</span></a>
            </li>
            <li class="menu-item-has-children"><a href="{{ route('check-in') }}"><i class="list-icon feather feather-user-plus"></i> <span class="hide-menu">Check in <span class="badge bg-primary"></span></span></a>
            </li>
            <li class="menu-item-has-children"><a href="{{ route('players.index') }}"><i class="list-icon feather feather-more-vertical"></i> <span class="hide-menu">Overzicht Spelers</span></a>
            </li>
            <li class="menu-item-has-children"><a href="{{ route('categories.index') }}"><i class="list-icon feather feather-more-horizontal"></i> <span class="hide-menu">Overzicht Categorien</span></a>
            </li>
            <li class="menu-item-has-children"><a href="{{ route('categories.new') }}"><i class="list-icon feather feather-plus"></i> <span class="hide-menu">Voeg Categorie toe</span></a>
            </li>
            <li class="menu-item-has-children"><a href="{{ route('players.new') }}"><i class="list-icon feather feather-plus"></i> <span class="hide-menu">Voeg speler toe</span></a>
            </li>
        @endauth
        <!-- Guest Menu -->
        @guest
        <li class="current-page menu-item-has-children"><a href="{{ route('filter.new') }}"><i class="list-icon feather feather-menu"></i> <span class="hide-menu">Ranglijst</span></a>
        </li>
        <li class="menu-item-has-children"><a href="{{ route('check-in') }}"><i class="list-icon feather feather-user-plus"></i> <span class="hide-menu">Check in <span class="badge bg-primary"></span></span></a>
        </li>
        <li class="menu-item-has-children"><a href="{{ route('players.new') }}"><i class="list-icon feather feather-plus"></i> <span class="hide-menu">Voeg speler toe</span></a>
        @endguest
    </ul>
    <!-- /.side-menu -->
</nav>
<!-- /.sidebar-nav -->
