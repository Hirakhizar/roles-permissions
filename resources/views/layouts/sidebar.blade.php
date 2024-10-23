 <aside
     class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
     id="sidenav-main">

     <div class="sidenav-header">
         <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
             aria-hidden="true" id="iconSidenav"></i>
         <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
             target="_blank">
             <img src="{{ asset('assets/mylogo.png') }}" class="navbar-brand-img h-100" alt="main_logo">
             <span class="ms-1 font-weight-bold text-white">Blogs</span>
         </a>
     </div>


     <hr class="horizontal light mt-0 mb-2">

     <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
         <ul class="navbar-nav">









             <li class="nav-item">
                 <a class="nav-link text-white " href="{{ url('/dashboard') }}">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">dashboard</i>
                     </div>

                     <span class="nav-link-text ms-1">Dashboard</span>
                 </a>
             </li>
             @if ($authenticUser->hasRole('admin'))
                 <!-- Roles Link -->
                 <li class="nav-item">
                     <a class="nav-link text-white" href="{{ route('roles') }}">
                         <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                             <i class="material-icons opacity-10">group</i> <!-- Icon for Roles -->
                         </div>
                         <span class="nav-link-text ms-1">Roles</span>
                     </a>
                 </li>


                 <!-- Permissions Link -->
                 <li class="nav-item">
                     <a class="nav-link text-white" href="{{ route('permissions') }}">
                         <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                             <i class="material-icons opacity-10">lock</i> <!-- Icon for Permissions -->
                         </div>
                         <span class="nav-link-text ms-1">Permissions</span>
                     </a>
                 </li>
                 <!-- Assign Permissions Link -->
                 <li class="nav-item">
                     <a class="nav-link text-white" href="{{ route('manage-assignments') }}">
                         <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                             <i class="material-icons opacity-10">security</i> <!-- Icon for Assign Permissions -->
                         </div>
                         <span class="nav-link-text ms-1">Assign Roles/Permissions</span>
                     </a>
                 </li>
             @endif
             <li class="nav-item">
                 <a class="nav-link text-white" href="{{ route('categories') }}">
                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">category</i> <!-- Icon for Categories -->
                     </div>
                     <span class="nav-link-text ms-1">Categories</span>
                 </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-white" href="{{ route('posts') }}">
                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">article</i> <!-- Icon for Posts -->
                     </div>
                     <span class="nav-link-text ms-1">Posts</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/tables.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">table_view</i>
                     </div>

                     <span class="nav-link-text ms-1">Tables</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/billing.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">receipt_long</i>
                     </div>

                     <span class="nav-link-text ms-1">Billing</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/virtual-reality.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">view_in_ar</i>
                     </div>

                     <span class="nav-link-text ms-1">Virtual Reality</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/rtl.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
                     </div>

                     <span class="nav-link-text ms-1">RTL</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/notifications.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">notifications</i>
                     </div>

                     <span class="nav-link-text ms-1">Notifications</span>
                 </a>
             </li>


             <li class="nav-item mt-3">
                 <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
             </li>

             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/profile.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">person</i>
                     </div>

                     <span class="nav-link-text ms-1">Profile</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/sign-in.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">login</i>
                     </div>

                     <span class="nav-link-text ms-1">Sign In</span>
                 </a>
             </li>


             <li class="nav-item">
                 <a class="nav-link text-white " href="./pages/sign-up.html">

                     <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                         <i class="material-icons opacity-10">assignment</i>
                     </div>

                     <span class="nav-link-text ms-1">Sign Up</span>
                 </a>
             </li>







         </ul>
     </div>



 </aside>
