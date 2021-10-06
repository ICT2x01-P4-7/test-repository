<nav class="navbar navbar-white bg-white">
    <div class="container-fluid">
    <span id="homeScreen" class="navbar-brand mb-0 h3"><img src="../src/AHMLX logo.png" height="35"> AHMLX</span> 
    <ul class="nav me-2">
        <li class="nav-item">
            <a class="nav-link" href="#">Games</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal">Settings</a>
        </li>
    </ul>
    </div>
</nav>

      <?php
      include "../Settings/settings.php"
      ?>

<script>
    $(document).ready(function () {  
        $(".nav-item").click(function () {
            $("ul").find(".active").removeClass("active");
            $(this).addClass("active");
        });    
    });
</script>
