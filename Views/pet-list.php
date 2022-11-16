<?php
require_once(VIEWS_PATH . "header.php");
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <a href="<?php echo FRONT_ROOT ?>User/ShowProfileView">Volver</a>
            <h2 class="mb-4">Listado de mascotas</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Raza</th>
                    <th>Tamaño</th>
                    <th>Perfil</th>
                    <th>Reserva</th>
                </thead>
                <tbody>

                    <?php for ($i = 0; $i < count($petList); $i++) { ?>
                        <tr>
                            <td><?php echo $petList[$i]->getName() ?></td>
                            <td><?php switch ($breeds[$i]->getType()) {
                                    case 1:
                                        echo "Gato";
                                        break;
                                    case "2":
                                        echo "Perro";
                                        break;
                                } ?></td>
                            <td><?php echo $breeds[$i]->getName() ?></td>
                            <td><?php switch ($breeds[$i]->getSize()) {
                                    case 1:
                                        echo "Pequeño";
                                        break;
                                    case 2:
                                        echo "Mediano";
                                        break;
                                    case 3:
                                        echo "Grande";
                                        break;
                                } ?></td>
                            <td>
                                <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $petList[$i]->getPetid() ?>" class="btn btn-primary btn-sm">Ver perfil</a>
                            </td>
                            <td>
                                <?php if ($petList[$i]->getStatus() == 2) { ?>
                                    <a href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView/<?php echo $petList[$i]->getPetid() ?>" class="btn btn-primary btn-sm">Solicitar Reserva</a>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-primary btn-sm" disabled>Solicitar Reserva</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>