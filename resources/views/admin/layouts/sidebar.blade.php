       <div id="layoutSidenav_nav">
           <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
               <div class="sb-sidenav-menu">
                   <div class="nav">

                       <a class="nav-link pt-4" href="index.html">
                           <div class="sb-nav-link-icon"><i class="fas fa-store"></i></div>
                           Store
                       </a>
                       <hr>

                       <a class="nav-link" href="index.html">
                           <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                           Home
                       </a>

                       <div class="sb-sidenav-menu-heading">Market</div>
                       <a class="nav-link" href="index.html">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           Dashboard
                       </a>

                       <div class="sb-sidenav-menu-heading">Content</div>


                       <a class="nav-link" href="{{ route('admin.content.post.index') }}">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           Posts
                       </a>
                       <a class="nav-link" href="{{ route('admin.content.category.index') }}">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           Post Catgeories
                       </a>
                       <a class="nav-link" href="{{ route('admin.content.menu.index') }}">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           Menus
                       </a>
                       <a class="nav-link" href="{{ route('admin.content.comment.index') }}">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           Comments
                       </a>
                       <a class="nav-link" href="{{ route('admin.content.faq.index') }}">
                           <div class="sb-nav-link-icon"><i class="fas fa-bars"></i></div>
                           FAQ
                       </a>

                       <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                           <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                           Layouts
                           <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                       </a>
                       <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                           data-bs-parent="#sidenavAccordion">
                           <nav class="sb-sidenav-menu-nested nav">
                               <a class="nav-link" href="layout-static.html">Static Navigation</a>
                               <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                           </nav>
                       </div>
                       <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                           data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                           <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                           Pages
                           <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                       </a>
                       <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                           data-bs-parent="#sidenavAccordion">
                           <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                   data-bs-target="#pagesCollapseAuth" aria-expanded="false"
                                   aria-controls="pagesCollapseAuth">
                                   Authentication
                                   <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                               </a>
                               <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                                   data-bs-parent="#sidenavAccordionPages">
                                   <nav class="sb-sidenav-menu-nested nav">
                                       <a class="nav-link" href="login.html">Login</a>
                                       <a class="nav-link" href="register.html">Register</a>
                                       <a class="nav-link" href="password.html">Forgot Password</a>
                                   </nav>
                               </div>
                               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                   data-bs-target="#pagesCollapseError" aria-expanded="false"
                                   aria-controls="pagesCollapseError">
                                   Error
                                   <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                               </a>
                               <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                                   data-bs-parent="#sidenavAccordionPages">
                                   <nav class="sb-sidenav-menu-nested nav">
                                       <a class="nav-link" href="401.html">401 Page</a>
                                       <a class="nav-link" href="404.html">404 Page</a>
                                       <a class="nav-link" href="500.html">500 Page</a>
                                   </nav>
                               </div>
                           </nav>
                       </div>
                       <div class="sb-sidenav-menu-heading">Users</div>
                       <a class="nav-link" href="charts.html">
                           <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                           Charts
                       </a>
                       <a class="nav-link" href="tables.html">
                           <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                           Tables
                       </a>
                   </div>
               </div>
               <div class="sb-sidenav-footer">
                   <div class="small">Logged in as:</div>
                   Start Bootstrap
               </div>
           </nav>
       </div>
