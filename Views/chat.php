<?php
    require_once(VIEWS_PATH."header.php");
    require_once('nav.php');
?>

<div class="container py-5 bg-light-alpha rounded" >

    <div class="row">
<!--caja de todas las conversaciones-->
<!--        <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">-->

<!--            <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>-->
<!---->
<!--            <div class="card">-->
<!--                <div class="card-body">-->
<!---->
<!--                    <ul class="list-unstyled mb-0">-->
<!--                        <li class="p-2 border-bottom" style="background-color: #eee;">-->
<!--                            <a href="#!" class="d-flex justify-content-between">-->
<!--                                <div class="d-flex flex-row">-->
<!--                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar"-->
<!--                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">-->
<!--                                    <div class="pt-1">-->
<!--                                        <p class="fw-bold mb-0">John Doe</p>-->
<!--                                        <p class="small text-muted">Hello, Are you there?</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="pt-1">-->
<!--                                    <p class="small text-muted mb-1">Just now</p>-->
<!--                                    <span class="badge bg-danger float-end">1</span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--<                         chat seleccionado-->
<!--                        <li class="p-2 border-bottom">-->
<!--                            <a href="#!" class="d-flex justify-content-between">-->
<!--                                <div class="d-flex flex-row">-->
<!--                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp" alt="avatar"-->
<!--                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">-->
<!--                                    <div class="pt-1">-->
<!--                                        <p class="fw-bold mb-0">Danny Smith</p>-->
<!--                                        <p class="small text-muted">Lorem ipsum dolor sit.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="pt-1">-->
<!--                                    <p class="small text-muted mb-1">5 mins ago</p>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                           chat sin seleccionar-->
<!--                        <li class="p-2">-->
<!--                            <a href="#!" class="d-flex justify-content-between">-->
<!--                                <div class="d-flex flex-row">-->
<!--                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"-->
<!--                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">-->
<!--                                    <div class="pt-1">-->
<!--                                        <p class="fw-bold mb-0">Brad Pitt</p>-->
<!--                                        <p class="small text-muted">Lorem ipsum dolor sit.</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="pt-1">-->
<!--                                    <p class="small text-muted mb-1">5 mins ago</p>-->
<!--                                    <span class="text-muted float-end"><i class="fas fa-check" aria-hidden="true"></i></span>-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                            ultimo chat de la lista (no tiene el border bottom)-->
<!--                    </ul>-->
<!---->
<!--                </div>-->
<!--            </div>-->

<!--        </div>-->
<!--caja del chat actual-->
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
                            <div class="card">
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
                                    <?php if($message->getStatus() == "read"){ ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16" color="blue">
                                            <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                            <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                        </svg>
                                    <?php } ?>
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
<!--            <ul class="list-unstyled">-->
<!--                <li class="d-flex justify-content-between mb-4">-->
<!--                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"-->
<!--                         class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">-->
<!--                    <div class="card">-->
<!--                        <div class="card-header d-flex justify-content-between p-3">-->
<!--                            <p class="fw-bold mb-0">Brad Pitt</p>-->
<!--                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>-->
<!--                        </div>-->
<!--                        <div class="card-body">-->
<!--                            <p class="mb-0">-->
<!--                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut-->
<!--                                labore et dolore magna aliqua.-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                    mensaje recibido-->
<!--                <li class="d-flex justify-content-between mb-4">-->
<!--                    <div class="card w-100">-->
<!--                        <div class="card-header d-flex justify-content-between p-3">-->
<!--                            <p class="fw-bold mb-0">Lara Croft</p>-->
<!--                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>-->
<!--                        </div>-->
<!--                        <div class="card-body">-->
<!--                            <p class="mb-0">-->
<!--                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque-->
<!--                                laudantium.-->
<!--                            </p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"-->
<!--                         class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">-->
<!--                </li>-->
<!--                    mensaje enviado-->
                <form action="<?php echo FRONT_ROOT ?>Chat/Add/" method="post">
                    <li class="bg-white mb-3">
                        <div class="form-outline">
                            <textarea class="form-control" id="text" name="text" rows="4" placeholder="Escribe un mensaje"></textarea>
                        </div>
                    </li>
                    <input type="hidden" name="receiverid" value="<?php echo $receiverid ?>">
                    <!--                    caja para escribir el mensaje-->
                    <button type="submit" class="btn btn-success">Send</button>
                </form>
<!--                    boton de enviar mensaje-->
            </ul>

        </div>

    </div>

</div>

<?php 
    require_once(VIEWS_PATH."footer.php");
?>