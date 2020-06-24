<template >
  <div>
    <header class="app-header navbar">
      <button
        class="navbar-toggler sidebar-toggler d-lg-none mr-auto"
        type="button"
        data-toggle="sidebar-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <router-link class="navbar-brand" :to="{name: 'welcome'}">
        <img
          class="navbar-brand-full"
          src="/img/brand/logo.png"
          width="108"
          height="35"
          alt="MCCStoTomas"
        />
        <img
          class="navbar-brand-minimized"
          src="/img/brand/sygnet.png"
          width="35"
          height="35"
          alt="CoreUI Logo"
        />
      </router-link>
      <button
        class="navbar-toggler sidebar-toggler d-md-down-none"
        type="button"
        data-toggle="sidebar-lg-show"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3">@yield('bodyTitle')</li>
      </ul>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown" style="margin-right:20px">
          <a
            class="dropdown-toggle"
            style="cursor: pointer;"
            data-toggle="dropdown"
            role="button"
            aria-expanded="false"
          >
            <!-- {{ Auth::user()->name }} <span class="caret"></span> -->
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Account</strong>
            </div>

            <!-- {{ csrf_field() }} -->
          </div>
        </li>
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'dashboard'}">
                <i class="nav-icon fa fa-dashboard"></i> Dashboard
              </router-link>
              <!-- <router-link :to="{name: 'createCompany'}" class="btn btn-success">Create new company</router-link> -->
            </li>
            <li class="nav-title">Datasets</li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'userIndex'}">
                <i class="nav-icon fa fa-users"></i> Users
              </router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" :to="{name: 'reportIndex'}">
                <i class="nav-icon fa fa-list-alt"></i> Reports
              </router-link>
            </li>
            <li class="divider"></li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <div class="container-fluid" style="padding:15px;">
          <div class="animated fadeIn">
            <!-- @yield('content') -->
            <div class="container">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </main>
    </div>

    <footer class="app-footer">
      <div>
        <a href="/">Municipal Command Center of Sto. Tomas</a>
        <span>&copy; 2019</span>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  data: () => ({
    drawer: null
  }),
  props: {
    source: String
  }
};
</script>