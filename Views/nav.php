<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">

    <a href="<?php echo FRONT_ROOT ?>">
        <img src="<?php echo FRONT_ROOT ?>Views/img/logo.png" height="65" alt="logo">
    </a>

    <ul class="navbar-nav ml-auto">

        <!-- Admin -->
        <li class="nav-item">
            <!-- HECHO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Dueno/ShowListView">Ver Todos Los Dueño</a>
        </li>
        <li class="nav-item">
            <!-- HECHO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Mascota/ShowListView">Ver Todas Las Mascotas</a>
        </li>
        <!-- HECHO -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Guardian/ShowListView">Ver Todos Los Guardianes</a>
        </li>

        <li class="nav-item">
            <!-- VER COMO HACER PARA QUE LA MASCOTA CREADA SEA DEL DUEÑO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Mascota/ShowAddView">Crear Perfil Mascota</a>
        </li>

        <li class="nav-item">
            <!-- HECHO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Person/AddPerson">Crear Perfil</a>
        </li>

        <li class="nav-item">
            <!-- HECHO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>Person/LogInView">Log In</a>
        </li>

        <!--  -->

        

        <!-- solo para dueño -->
        <li class="nav-item">
            <!-- VER COMO HACER PARA QUE LA MASCOTA CREADA SEA DEL DUEÑO -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>#">Crear Perfil Mi Mascota</a>
        </li>
        <li class="nav-item">
            <!-- VER COMO HACER PARA QUE VEA SOLO SUS MASCOTAS -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>#">Ver Mis Mascotas</a>
        </li>
        <!--  -->


        <!-- Solo para invitados/antes de loguearse -->
        <!-- log in -->
        <!-- sign in/Crear perfil -->
        <!--  -->

        <!-- Solo para guardian -->
        <li class="nav-item">
            <!-- 2da entrega -->
            <a class="nav-link" href="<?php echo FRONT_ROOT ?>#">Ver Mis Reservas</a>
        </li>
        <!-- Ver sus reservas (aceptarlas o no, estado de pago, bla) -->
        <!--  -->

    </ul>
</nav>