<nav class="navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="container-xxl">
      <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
          <a href="{{ route('dashboard') }}" class="app-brand-link gap-2">
              <span class="app-brand-text demo menu-text fw-medium"><img src="{{ asset('admin') }}/img/wbs-logo.png"
                      alt="logo" class="w-px-100"></span>
          </a>
      </div>
      <div class="menu-horizontal-wrapper">
          <ul class="menu-inner">
              <!-- Dashboard -->
              <li class="menu-item @if (request()->routeIs('dashboard')) active @endif">
                  <a href="{{ route('dashboard') }}" class="menu-link @if (request()->routeIs('dashboard')) active @endif">
                      <i class="menu-icon tf-icons bx bx-home-circle"></i>
                      <div data-i18n="Analytics">Dashboard</div>
                  </a>
              </li>

              <!-- Layouts -->
              <li class="menu-item @if (request()->routeIs('inquiries.index')) active @endif">
                  <a href="{{ route('inquiries.index') }}" class="menu-link @if (request()->routeIs('inquiries.index')) active @endif">
                      <i class="menu-icon tf-icons bx bx-layout"></i>
                      <div data-i18n="Layouts">Inquiries</div>
                  </a>
              </li>

              <li class="menu-item @if (request()->routeIs('users.index')) active @endif ">
                  <a href="{{ route('users.index') }}" class="menu-link @if (request()->routeIs('users.index')) active @endif">
                      <i class="menu-icon tf-icons bx bx-user"></i>
                      <div data-i18n="Layouts">Users</div>
                  </a>
              </li>
          </ul>
      </div>
      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


          <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <div class="avatar avatar-online">
                          <img src="{{ asset('admin') }}/img/avatars/1.png" alt
                              class="w-px-40 h-auto rounded-circle" />
                      </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
                      <li>
                          <a class="dropdown-item" href="pages-account-settings-account.html">
                              <div class="d-flex">
                                  <div class="flex-shrink-0 me-3">
                                      <div class="avatar avatar-online">
                                          <img src="{{ asset('admin') }}/img/avatars/1.png" alt=""
                                              class="w-px-40 h-auto rounded-circle">
                                      </div>
                                  </div>
                                  <div class="flex-grow-1">
                                      <span class="fw-medium d-block">{{ auth()->user()->name }}</span>
                                      <small class="text-muted">{{ auth()->user()->designation }}</small>
                                  </div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <div class="dropdown-divider"></div>
                      </li>
                      <li>
                          <a class="dropdown-item" href="{{ route('logout') }}" target="_blank">
                              <i class="bx bx-power-off me-2"></i>
                              <span class="align-middle">Log Out</span>
                          </a>
                      </li>
                  </ul>
              </li>
              <!--/ User -->
          </ul>
      </div>
  </div>
</nav>