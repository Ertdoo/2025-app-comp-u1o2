<?php
session_start(); // Start session early
if (isset($_GET['logout'])) {
    $_SESSION["session_logged"] = "loggedout";
    session_destroy();
    session_regenerate_id(true);
    header("Location: /0/school/2025yr11php/login.php");
    exit();
} ?><nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/0/school/2025yr11php/index.php">11 App Comp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" 
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav me-auto">
        <!-- CRUD Dropdown -->
        <li class="nav-item dropdown ms-5">
          <a class="nav-link dropdown-toggle" href="#" id="crudDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CRUD
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="crudDropdown">
            <li><a class="dropdown-item" href="crud_create.php">CRUD create</a></li>
            <li><a class="dropdown-item" href="crud_read.php">CRUD read</a></li>
            <li><a class="dropdown-item" href="crud_update.php">CRUD update</a></li>
            <li><a class="dropdown-item" href="crud_delete.php">CRUD delete</a></li>
            <li><a class="dropdown-item" href="crud_operations_table.php">Operations Table</a></li>
            <li><a class="dropdown-item" href="crud_operations_table.php">Make Bobby</a></li>
          </ul>
        </li>

        <!-- PHP Dropdown -->
        <li class="nav-item dropdown ms-5">
          <a class="nav-link dropdown-toggle" href="#" id="phpDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PHP
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="phpDropdown">
            <li><a class="dropdown-item" href="core_php_variables.php">Variables</a></li>
            <li><a class="dropdown-item" href="core_php_selection.php">Selection</a></li>
            <li><a class="dropdown-item" href="core_php_loops.php">Loops</a></li>
            <li><a class="dropdown-item" href="core_php_arrays.php">Arrays</a></li>
          </ul>
        </li>

        <!-- Projects Dropdown -->
        <li class="nav-item dropdown ms-5">
          <a class="nav-link dropdown-toggle" href="#" id="projectsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PROJECTS
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="projectsDropdown">
            <li><a class="dropdown-item" href="proj_paycalc.php">Pay Calculator</a></li>
            <li><a class="dropdown-item" href="proj_hangman.php">Hangman</a></li>
            <li><a class="dropdown-item" href="proj_sight_reading.php">Sight-Reading</a></li>
            <li><a class="dropdown-item" href="proj_biggerNum.php">PsuedoCode - biggestNum</a></li>
          </ul>
        </li>
      </ul>

      <!-- Login/Logout Buttons -->
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item ms-2">
            <a class="btn btn-outline-danger btn-sm" href="?logout=true">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item ms-2">
            <a class="btn btn-outline-success btn-sm" href="/0/school/2025yr11php/login.php">Login</a>
          </li>
          <li class="nav-item ms-2">
            <a class="btn btn-outline-warning btn-sm" href="/0/school/2025yr11php/signup.php">Sign up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
