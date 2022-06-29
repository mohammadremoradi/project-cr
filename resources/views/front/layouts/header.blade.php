<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-users"></i>
                <span class="badge badge-danger navbar-badge">88</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right overflow-auto" style="height: 18rem">

                {{-- @foreach ($unseenClients as $unseenClient)
                    <a href="{{ route('appointment.view', $unseenClient->id) }}" class="dropdown-item ">
                        <!-- Message Start -->
                        <div dir="" class="media">
                            <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    {{ $unseenClient->fullname }}
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <br>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                    {{ Carbon\Carbon::parse($unseenClient->created_at)->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>

                    <div class="dropdown-divider"></div>
                @endforeach --}}
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    {{-- @if ($unseenUsers->count() != 0) --}}
                        <span class="badge badge-warning navbar-badge">

                            44
                        </span>
                    {{-- @endif --}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"> 99
                        Notifications</span>
                    <div class="dropdown-divider"></div>
                    {{-- @foreach ($unseenUsers as $unseenUser)
                        <a href="#" class="dropdown-item ">
                            <!-- Message Start -->
                            <div dir="" class="media">
                                <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        {{ $unseenUser->name }}
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <br>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                        {{ Carbon\Carbon::parse($unseenUser->updated_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                    @endforeach --}}
                </div>
            </li>

            
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="{{ route('profile.show') }}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        <i class="fas fa-sign-out-alt mr-2" aria-hidden="true"></i>
                        Logout</button>
                </form>
            </div>
        </li>


    </ul>
</nav>
