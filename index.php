<?php include_once "header.php"; ?>
<?php include_once "menubar_new.php"; ?>
<!DOCTYPE html>
<html>
<script>
console.log('Popper loaded:', typeof Popper !== 'undefined');
</script>
<div class="d-flex justify-content-center align-items-center vh-100 bg-dark">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all navbar elements
        const navbar = document.querySelector('.navbar');
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
    
        // Close all dropdowns function
        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                toggle.setAttribute('aria-expanded', 'false');
            });
        }
    
        // Handle dropdown toggles
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            
                // Close any other open dropdowns first
                closeAllDropdowns();
            
                // Toggle this dropdown
                const dropdownMenu = this.nextElementSibling;
                const isOpen = dropdownMenu.classList.contains('show');
            
                if (!isOpen) {
                    dropdownMenu.classList.add('show');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
    
        // Close dropdowns when clicking regular nav links
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeAllDropdowns();
            });
        });
    
        // Close dropdowns when clicking anywhere else
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                closeAllDropdowns();
            }
        });
    });
    </script>
    <body style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4 text-white">Home Page Test</h2>
    <script>
    // Debugging Bootstrap dropdown
    console.log('Bootstrap loaded:', typeof bootstrap !== 'undefined');
    console.log('Dropdown component:', typeof bootstrap.Dropdown !== 'undefined');

    // Manually initialize dropdowns if needed
    document.querySelectorAll('.dropdown-toggle').forEach(function(dropdownToggle) {
        new bootstrap.Dropdown(dropdownToggle);
    });
    </script>
    <body>
</div>
<?php include_once "footer.php"; ?>
