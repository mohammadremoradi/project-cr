<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="{{ asset('admin/images/logo_circle.jpeg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Beyond Universal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.index') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                @can('all-my-client')

                    <li class="nav-item ">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-users  "></i>
                            <p>
                                Clients
                                <i class="fas fa-angle-left right"></i>
                                @if ($today_number)
                                    <span class="right badge badge-danger">New</span>
                                @endif
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @can('all-my-client')
                                <li class="nav-item">
                                    <a href="{{ route('client.my') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            My Clients
                                            {{-- <span class="badge badge-info right">6</span> --}}
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('client.today') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Today
                                            @if ($today_number)
                                                <span class="badge badge-info right">{{ $today_number }}</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>

                            @endcan


                            @can('all-client-list')
                                <li class="nav-item">
                                    <a href="{{ route('client.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            All Clients
                                        </p>
                                    </a>
                                </li>
                            @endcan

                            @can('show-client-delete')
                                <li class="nav-item">
                                    <a href="{{ route('client.deletes.view') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Delete Clients
                                            {{-- <span class="badge badge-info right">6</span> --}}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user-check nav-icon" aria-hidden="true"></i>
                        <p>
                            Applicant
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    @can('consumer')
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('consumer.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        All Applicant
                                    </p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ route('consumer.waiting') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        Waiting list
                                    </p>

                                    @if ($waiting)
                                        <span class="right badge badge-danger">New</span>
                                    @endif
                                </a>
                            </li>

                        </ul>
                    @endcan
                </li>


                <li class="nav-item">
                    @can('notify-sms')
                        <a href="#" class="nav-link">
                            <i class="fa fa-bell nav-icon" aria-hidden="true"></i>
                            <p>
                                Notification
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcan
                    <ul class="nav nav-treeview">

                        @can('notify-sms')
                            <li class="nav-item">
                                <a href="{{ route('sms.index') }}" class="nav-link">
                                    <i class="fas fa-sms nav-icon"></i>
                                    <p>
                                        Sms
                                    </p>
                                </a>
                            </li>
                        @endcan
                        @can('notify-email')
                            <li class="nav-item">
                                <a href="{{ route('email.index') }}" class="nav-link">
                                    <i class="fa fa-envelope nav-icon" aria-hidden="true"></i>
                                    <p>
                                        Email
                                    </p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
                {{-- <li class="nav-header"> Accounting </li> --}}


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-dollar-sign"></i>
                        <p>
                            Accounting
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa- nav-icon"></i>
                                <p>
                                    Advertise
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('accounting-advertise-budget')
                                    <li class="nav-item">
                                        <a href="{{ route('budget.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>budget</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('accounting-advertise-sourse')
                                    <li class="nav-item">
                                        <a href="{{ route('sourse.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Sourse</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('accounting-advertise')
                                    <li class="nav-item">
                                        <a href="{{ route('advertise.index') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Advertise</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                        {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>
                            Login & Register v2
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="pages/examples/login-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Login v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/register-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Register v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Forgot Password v2</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="pages/examples/recover-password-v2.html" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recover Password v2</p>
                            </a>
                          </li>
                        </ul>
                      </li> --}}
                    </ul>
                </li>





                @can('survey')

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-bar-chart"></i>
                        <p>
                            Statistics
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">

                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="{{ route('survey.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Survey</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>
                @endcan

                {{-- @can('setting-tag-client') --}}
                <li class="nav-header"> Settings </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon  fa fa-cogs"></i>
                        <p>
                            Setting for Clients
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('setting-tag-client')
                            <li class="nav-item">
                                <a href="{{ route('tags.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tags</p>
                                </a>
                            </li>
                        @endcan
                        @can('setting-service-client')
                            <li class="nav-item">
                                <a href="{{ route('services.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Servises</p>
                                </a>
                            </li>
                        @endcan
                        @can('setting-status-client')
                            <li class="nav-item">
                                <a href="{{ route('status.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Status applicant </p>
                                </a>
                            </li>
                        @endcan

                    </ul>

                </li>
                {{-- @endcan --}}
                <li class="nav-item">
                    @can('setting-user-page')
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endcan

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
