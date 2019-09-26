<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="<?php echo base_url() ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-folder"></i>
      <span>User</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="pagesDropdown">
      <h6 class="dropdown-header">user:</h6>
      <a class="dropdown-item" href="<?php echo base_url('user/edit') ?>"><i class="fa fa-plus"></i> add user</a>
      <a class="dropdown-item" href="<?php echo base_url('user/list') ?>"><i class="fa fa-list"></i> user list</a>
      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">role:</h6>
      <a class="dropdown-item" href="<?php echo base_url('user/role') ?>"><i class="fa fa-list"></i> user role</a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="<?php echo base_url('kelas') ?>">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>kelas</span></a>
  </li>
</ul>