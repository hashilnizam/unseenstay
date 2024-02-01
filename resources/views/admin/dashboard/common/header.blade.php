<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('unseen.index')  }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">UnseenStay</sup></div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin_dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Interface
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('unseen.index') }}" target="_blank">
                <i class="fas fa-arrow-left"></i>
                <span>View Site</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
               aria-expanded="true" aria-controls="collapseProperties">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
            <div id="collapseUser" class="collapse" aria-labelledby="headingProperties"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Settings:</h6>
                    <a class="collapse-item" href="{{ route('show') }}">Users</a>
                    <a class="collapse-item" href="{{ route('user_feedback') }}">Feedback</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProperties"
               aria-expanded="true" aria-controls="collapseProperties">
                <i class="fas fa-building"></i>
                <span>Properties</span>
            </a>
            <div id="collapseProperties" class="collapse" aria-labelledby="headingProperties"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Updates:</h6>
                    <a class="collapse-item" href="{{ route('properties_list') }}">Properties List</a>
                    <a class="collapse-item" href="{{ route('room_list') }}">Room List</a>
                </div>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBlogs"
               aria-expanded="true" aria-controls="collapseBlogs">
                <i class="fas fa-blog"></i>
                <span>Blogs</span>
            </a>
            <div id="collapseBlogs" class="collapse" aria-labelledby="headingBlogs"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Blogs:</h6>
                    <a class="collapse-item" href="{{ route('blog_form') }}">Blog</a>
                    <a class="collapse-item" href="{{ route('blog_form_index') }}">Blog List</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBanner"
               aria-expanded="true" aria-controls="collapseBanner">
                <i class="fas fa-flag"></i>
                <span>Banner</span>
            </a>
            <div id="collapseBanner" class="collapse" aria-labelledby="headingProperties"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Banner Settings:</h6>
                    <a class="collapse-item" href="{{ route('banner') }}">Banner</a>
                    <a class="collapse-item" href="{{ route('banner_index') }}">Show Current Banner</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseContacts"
               aria-expanded="true" aria-controls="collapseContacts">
                <i class="fas fa-address-book"></i>
                <span>Contacts</span>
            </a>
            <div id="collapseContacts" class="collapse" aria-labelledby="collapseContacts"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Contact Settings:</h6>
                    <a class="collapse-item" href="{{ route('contact_form') }}">Contact</a>
                    <a class="collapse-item" href="{{ route('contact_index') }}">Show Current Banner</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInsta"
               aria-expanded="true" aria-controls="collapseInsta">
                <i class="fas fa-file-image"></i>
                <span>Images</span>
            </a>
            <div id="collapseInsta" class="collapse" aria-labelledby="collapseInsta"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Image Settings:</h6>
                    <a class="collapse-item" href="{{ route('insta_image') }}">Instagram Image</a>
                    <a class="collapse-item" href="{{ route('insta_index') }}">Show Instagram Images</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">
        <hr class="sidebar-divider d-none d-md-block">
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

            </nav>
