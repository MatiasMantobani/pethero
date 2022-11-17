<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>

<div class="container py-5 bg-light rounded" >
    <h2>Chat con <?php echo $receiverName ?></h2>
    <div class="row">
        <div class="col-md-6 col-lg-7 col-xl-12">

            <?php foreach ($messages as $message){ ?>
                <?php if($message->getSenderid() == $_SESSION['userid']){ ?>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between mb-4">
                            <?php if($senderImage != null){ ?>
                                <img src="<?php echo FRONT_ROOT . USER_UPLOADS_PATH . $senderImage->getName() ?>" alt="avatar"
                                     class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                            <?php }else { ?>
                                <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="avatar"
                                     class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                            <?php }?>
                            <div class="card w-100">
                                <div class="card-header d-flex justify-content-between p-3">
                                    <p class="fw-bold mb-0"><?php echo $senderName ?></p>
                                    <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?php echo $message->getTime() ?> </p>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">
                                        <?php echo $message->getText()?>
                                        <?php if($message->getStatus() == "read"){ ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16" color="blue">
                                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                            </svg>
                                        <?php }else{ ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                                <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                                <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                            </svg>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                <?php }else { ?>
                    <li class="d-flex justify-content-between mb-4">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0"><?php echo $receiverName ?></p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i> <?php echo $message->getTime() ?></p>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                    <?php echo $message->getText()?>
                                </p>
                            </div>
                        </div>
                        <?php if($receiverImage != null){ ?>
                            <img src="<?php echo FRONT_ROOT . USER_UPLOADS_PATH . $receiverImage->getName() ?>" alt="avatar"
                                 class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        <?php }else { ?>
                            <img src="<?php echo FRONT_ROOT ?>Views/img/profile/profile_default.png" alt="avatar"
                                 class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                        <?php }?>

                    </li>
                <?php }?>

            <?php } ?>
<!--                    mensaje enviado-->
                <form action="<?php echo FRONT_ROOT ?>Chat/Add/" method="post">
                    <li class="bg-white mb-3" style="list-style: none">
                        <div class="form-outline">
                            <textarea class="form-control" id="text" name="text" rows="4" maxlength="280" placeholder="Escribe un mensaje (maximo 280 caracteres)"></textarea>
                        </div>
                    </li>
                    <input type="hidden" name="receiverid" value="<?php echo $receiverid ?>">
                    <!--                    caja para escribir el mensaje-->
                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>
<!--                    boton de enviar mensaje-->
            </ul>

        </div>

    </div>

</div>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>