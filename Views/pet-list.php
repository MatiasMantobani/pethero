<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
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
                <?php if ($petList != null) {
                    foreach ($petList as $pet) {
                        if ($pet->getStatus() == 1) { ?>
                            <?php $breed = $breedController->getByBreedId($pet->getBreedid()); ?>
                            <tr>
                                <td><?php echo $pet->getName() ?></td>
                                <td><?php switch ($breed->getType()) {
                                        case 1:
                                            echo "Gato";
                                            break;
                                        case "2":
                                            echo "Perro";
                                            break;
                                    } ?></td>
                                <td><?php echo $breed->getName() ?></td>
                                <td><?php switch ($breed->getSize()) {
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
                                    <a href="<?php echo FRONT_ROOT ?>Pet/ShowProfileView/<?php echo $pet->getPetid() ?>" class="btn btn-primary btn-sm">Ver perfil</a>
                                </td>
                                <td>

                                    <a href="<?php echo FRONT_ROOT ?>Reserve/ShowAddView/<?php echo $pet->getPetid() ?>" class="btn btn-primary btn-sm">Solicitar Reserva</a>
                                </td>
                            </tr>
                        <?php }
                    }
                } ?>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>