<header id="page-header">
    <nav>
        <section class="nav-wrapper container">
            <ul id="title" class="left">
                <li>
                    <btn-nav data-activates="side-nav">
                        <i class="material-icons">menu</i>
                    </btn-nav>
                </li>
                <li>
                    <a href="{!! route('index') !!}">PUBTRANSAPP</a>
                </li>
            </ul>
            <ul id="navigation" class="right hide-on-med-and-down">
                <li>
                    <a href="{!! route('schedules.index') !!}">Schedules</a>
                </li>
                <li>
                    <a href="{!! route('stations.index') !!}">Stations</a>
                </li>
                @if ( ! auth()->check())
                    <li>
                        <a href="{!! route('login') !!}">Login</a>
                    </li>
                @else
                    <li>
                        <a href="{!! route('trains.index') !!}">Trains</a>
                    </li>
                    <li>
                        <a href="{!! route('operators.index') !!}">Operators</a>
                    </li>
                    <li>
                        <a href="{!! route('logout') !!}">Logout</a>
                    </li>
                @endif
            </ul>
        </section>
    </nav>
</header>