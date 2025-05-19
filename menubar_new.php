<?php
  session_start(); 

  if (isset($_GET['logout'])) {
      $_SESSION["session_logged"] = "loggedout"; 
      // It's good practice to regenerate the session ID on login/logout 
      // to prevent session fixation, though not strictly the cause of this issue.
      session_regenerate_id(true); 
      header("Location: login.php"); 
      exit();
  }
?>
<?php 
include_once "header.php";
?>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/0/school/2025yr11php/index.php">11 App Comp</a> <!-- redirects to index.php using absolute paths -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
      data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" 
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav ">
        <li class="nav-item dropdown" style="margin-left: 200px;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            CRUD
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="crud_create.php">CRUD create</a></li>
            <li><a class="dropdown-item" href="crud_read.php">CRUD read</a></li>
            <li><a class="dropdown-item" href="crud_update.php">CRUD update</a></li>
            <li><a class="dropdown-item" href="crud_delete.php">CRUD delete</a></li>
            <li><a class="dropdown-item" href="crud_operations_table.php">Operations Table</a></li>
            <li><a class="dropdown-item" href="crud_operations_table.php">Make Bobby</a></li>
            
          </ul>
        </li>

        <li class="nav-item dropdown" style="margin-left: 100px;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PHP
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="crud_create.php">Variables</a></li>
            <li><a class="dropdown-item" href="crud_read.php">Selection </a></li>
            <li><a class="dropdown-item" href="crud_update.php">Loops </a></li>
            <li><a class="dropdown-item" href="crud_delete.php">Arrays </a></li>
            
          </ul>
        </li>

        <li class="nav-item dropdown" style="margin-left: 100px;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PROJECTS
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="paycalc/paycalc.php">Pay Calculator</a></li>

            
          </ul>
        </li>

      </ul>
    </div>



    <div style="float:right;">
          <ul >
            <?php 
            // This condition will now correctly reflect the session state AFTER potential logout
            if(isset($_SESSION["session_logged"])) {
              if ($_SESSION["session_logged"] == "loggedout") { ?>
                <li class="nav-item btn btn-outline-success btn-sm">
                    <a class="nav-link" href="/0/school/2025yr11php/login.php">Login</a> <!--uses absolute paths-->
                </li>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <li class="ml-1 nav-item btn btn-outline-warning btn-sm">
                    <a class="nav-link" href="/0/school/2025yr11php/signup.php">Sign up</a>
                </li>
              <?php } else { ?>
                <li class="nav-item btn btn-outline-danger btn-sm">
                    <a class="nav-link" href="?logout=true">Logout</a>
                </li>
              <?php } ?>
            <?php } else { ?>
              <li class="nav-item btn btn-outline-success btn-sm">
                    <a class="nav-link" href="/0/school/2025yr11php/login.php">Login</a>
                </li>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <li class="ml-1 nav-item btn btn-outline-warning btn-sm">
                    <a class="nav-link" href="/0/school/2025yr11php/signup.php">Sign up</a>
                </li>
            <?php } ?>
          </ul>
    </div>
  </div>
</nav>


  
