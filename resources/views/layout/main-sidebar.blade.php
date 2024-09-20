<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <style>
        .user-panel .image img {
            border-radius: 50%; /* تأكيد دائرية الصورة */
            width: 40px; /* تغيير الحجم إذا لزم الأمر */
            height: 40px; /* تغيير الحجم إذا لزم الأمر */
        }
        .user-panel .info p {
    font-size: 1.125rem; /* حجم الخط يتناسب مع التصميم */
    font-weight: 600; /* سمك الخط يجعل الاسم بارزًا */
    color: hsl(227, 87%, 46%); /* لون الخط يتناسب مع لوحة الألوان */
    margin: 0; /* إزالة المسافات الزائدة */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* تأثير الظل لتحسين الرؤية */
}
        </style>
        

    @auth
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="image me-3">
                    <img src="{{ asset('images/hasan.jpg') }}" class="img-circle elevation-2" alt="User Image">

                </div>
                <div class="info">
                    <p class="mb-0">{{ Auth::user()->name }}</p>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="post">

                 
                 @csrf


                <button type="submit" class="btn btn-primary">Logout</button>

            </form>

           
             

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                   
                    <li class="nav-item menu-open">
                        <a href="{{route('dashboard.index')}}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('dashboard.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('apointments.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Apointments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('departments.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Departments</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('doctors.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Doctors</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('examinations.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Examinations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('invoices.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Invoices</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('medications.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Medications</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('availabletimes.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Available times</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('organizations.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Organizations</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('patients.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patients</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    @endauth
    @if (Auth::check()) // true , false

    @endif
    <!-- /.sidebar -->
