<?php
require_once('nav.php');
?>
<br>
<br>
<div class="container py-5 bg-light-alpha rounded" >

    <div class="row">
<!--caja de todas las conversaciones-->
        <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

            <h5 class="font-weight-bold mb-3 text-center text-lg-start">Member</h5>

            <div class="card">
                <div class="card-body">

                    <ul class="list-unstyled mb-0">
                        <li class="p-2 border-bottom" style="background-color: #eee;">
                            <a href="#!" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-8.webp" alt="avatar"
                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                    <div class="pt-1">
                                        <p class="fw-bold mb-0">John Doe</p>
                                        <p class="small text-muted">Hello, Are you there?</p>
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="small text-muted mb-1">Just now</p>
                                    <span class="badge bg-danger float-end">1</span>
                                </div>
                            </a>
                        </li>
<!--                            chat seleccionado-->
                        <li class="p-2 border-bottom">
                            <a href="#!" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp" alt="avatar"
                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                    <div class="pt-1">
                                        <p class="fw-bold mb-0">Danny Smith</p>
                                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="small text-muted mb-1">5 mins ago</p>
                                </div>
                            </a>
                        </li>
<!--                            chat sin seleccionar-->
                        <li class="p-2">
                            <a href="#!" class="d-flex justify-content-between">
                                <div class="d-flex flex-row">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                                         class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                    <div class="pt-1">
                                        <p class="fw-bold mb-0">Brad Pitt</p>
                                        <p class="small text-muted">Lorem ipsum dolor sit.</p>
                                    </div>
                                </div>
                                <div class="pt-1">
                                    <p class="small text-muted mb-1">5 mins ago</p>
                                    <span class="text-muted float-end"><i class="fas fa-check" aria-hidden="true"></i></span>
                                </div>
                            </a>
                        </li>
<!--                            ultimo chat de la lista (no tiene el border bottom)-->
                    </ul>

                </div>
            </div>

        </div>
<!--caja del chat actual-->
        <div class="col-md-6 col-lg-7 col-xl-8">

            <ul class="list-unstyled">
                <li class="d-flex justify-content-between mb-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                         class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between p-3">
                            <p class="fw-bold mb-0">Brad Pitt</p>
                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> 12 mins ago</p>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua.
                            </p>
                        </div>
                    </div>
                </li>
<!--                    mensaje recibido-->
                <li class="d-flex justify-content-between mb-4">
                    <div class="card w-100">
                        <div class="card-header d-flex justify-content-between p-3">
                            <p class="fw-bold mb-0">Lara Croft</p>
                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">
                                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                laudantium.
                            </p>
                        </div>
                    </div>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                         class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                </li>
<!--                    mensaje enviado-->
                <li class="bg-white mb-3">
                    <div class="form-outline">
                        <textarea class="form-control" id="textAreaExample2" rows="4" placeholder="Escribe un mensaje"></textarea>
                    </div>
                </li>
<!--                    caja para escribir el mensaje-->
                <button type="button" class="btn btn-success">Send</button>
<!--                    boton de enviar mensaje-->
            </ul>

        </div>

    </div>

</div>
