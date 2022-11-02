<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">

    <?php if (!isset($_SESSION['userid'])) { ?>
        <a href="<?php echo FRONT_ROOT ?>">
            <img src="<?php echo FRONT_ROOT ?>Views/img/logo.png" height="65" alt="logo">
        </a>
    <?php } else { ?>
        <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView">
            <img src="<?php echo FRONT_ROOT ?>Views/img/logo.png" height="65" alt="logo">
        </a>
    <?php } ?>

    <ul class="navbar-nav ml-auto">

        <?php if (!isset($_SESSION['userid'])) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowAddView">Registro</a>
            </li>
        <?php } ?>

        <?php if (isset($_SESSION['userid'])) { ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Inicio</a>
            </li>

            <?php if ($_SESSION['type'] == 'G') { ?>
            <?php } ?>

            <?php if ($_SESSION['type'] == 'D') { ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView">Crear Reserva</a>
                </li>

            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Auth/Logout">Salir</a>
            </li>

        <?php } ?>

    </ul>
</nav>