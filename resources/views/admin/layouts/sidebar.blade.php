
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin/dashboard" class="brand-link">
        <img src="{{ asset('admin/img/logo.jpg') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Coding Script</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/img/banner.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link {{ Request::path() == 'admin/dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Blog</li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Post
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/post" class="nav-link {{ Request::path() == 'admin/post' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('post.create') }}" class="nav-link {{ Request::path() == 'admin/post/create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    New
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/category" class="nav-link {{ Request::path() == 'admin/category' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/tag" class="nav-link {{ Request::path() == 'admin/tag' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>
                                    Tag
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Course</li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Course
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/course" class="nav-link {{ Request::path() == 'admin/course' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Courses
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('course.create') }}" class="nav-link {{ Request::path() == 'admin/course/create' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    New
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/language" class="nav-link {{ Request::path() == 'admin/language' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>
                                    Language
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/course-category" class="nav-link {{ Request::path() == 'admin/course-category' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>
                                    Categoey
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Lesson
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/lesson" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Lessons
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('lesson.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    New
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Forum</li>
                <li class="nav-item">
                    <a href="/admin/forum-category" class="nav-link">
                        <i class="fas fa-comments"></i>
                        <p>
                            Forum Category
                        </p>
                    </a>
                </li>
                <li class="nav-header">Extra</li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/role" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Role
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/permission" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Permission
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                  <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-external-link-alt"></i>
                    <p>
                      Live Site
                    </p>
                  </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
