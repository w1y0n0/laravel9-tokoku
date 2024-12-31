 <header class="main-header">
     <!-- Logo -->
     <a href="#" class="logo">
         <!-- mini logo for sidebar mini 50x50 pixels -->
         <span class="logo-mini"><b>PNC</b></span>
         <!-- logo for regular state and mobile devices -->
         <span class="logo-lg">{{ $setting->nama_perusahaan }}</span>
     </a>
     <!-- Header Navbar: style can be found in header.less -->
     <nav class="navbar navbar-static-top">
         <!-- Sidebar toggle button-->
         <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
             <span class="sr-only">Toggle navigation</span>
         </a>

         <div class="navbar-custom-menu">
             <ul class="nav navbar-nav">
                 <!-- User Account: style can be found in dropdown.less -->
                 <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <img src="{{ url(auth()->user()->foto) }}" class="user-image" alt="User Image">
                         <span class="hidden-xs">{{ auth()->user()->name }}</span>
                     </a>
                     <ul class="dropdown-menu">
                         <!-- User image -->
                         <li class="user-header">
                             <img src="{{ url(auth()->user()->foto) }}" class="img-circle img-profil" alt="User Image">

                             <p>
                                 {{ auth()->user()->name }}
                                 <small>[ {{ auth()->user()->username }} | {{ auth()->user()->email }} ]</small>
                             </p>
                         </li>

                         <!-- Menu Footer-->
                         <li class="user-footer">
                             <div class="pull-left">
                                 <a href="{{ route('user.profil') }}" class="btn btn-default btn-flat">Profil</a>
                             </div>
                             <div class="pull-right">
                                 <a href="#" class="btn btn-default btn-flat" id="logout-button">Keluar</a>
                             </div>
                         </li>
                     </ul>
                 </li>
             </ul>
         </div>
     </nav>
 </header>

 <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
     @csrf
 </form>
