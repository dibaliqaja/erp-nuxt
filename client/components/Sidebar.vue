<template>
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <div class="sidebar-brand-icon rotate-n-15">
        <fa icon="laugh-wink" fixed-width />
      </div>
      <div class="sidebar-brand-text mx-3">ERP Nuxt</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
      <a class="nav-link" href="/home"><fa icon="home" class="fa-sm fa-fw mr-2 text-gray-400" fixed-width /><b>Home</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/employee"><fa icon="users" class="fa-sm fa-fw mr-2 text-gray-400" fixed-width /><b>Employee</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/presence"><fa icon="file-alt" class="fa-sm fa-fw mr-2 text-gray-400" fixed-width /><b>Presence</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/activity/calendar"><fa icon="list" class="fa-sm fa-fw mr-2 text-gray-400" fixed-width /><b>Activity Report</b></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/salary"><fa icon="sticky-note" class="fa-sm fa-fw mr-2 text-gray-400" fixed-width /><b>Salary</b></a>
    </li>
  </ul>
  <!-- End of Sidebar -->
</template>
