<div class="container mt-5 d-flex justify-content-center">

            <div class="card p-3">

                <div class="d-flex align-items-center">

                    <div class="image">
                <img src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80" class="rounded" width="155" >
                </div>

                <?php
            
                $usuarioActual = unserialize($_SESSION["loggedUser"]); // No olvidarse de deserializar el SESSION
                
                ?>

                <div class="ml-3 w-100">
                    
                   <h4 class="mb-0 mt-0"><?php echo $usuarioActual->getFirstName(); ?></h4>
                   <span>Senior Journalist</span>

                   <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">

                    <div class="d-flex flex-column">

                        <span class="articles">Articles</span>
                        <span class="number1">38</span>
                        
                    </div>

                    <div class="d-flex flex-column">

                        <span class="followers">Followers</span>
                        <span class="number2">980</span>
                        
                    </div>


                    <div class="d-flex flex-column">

                        <span class="rating">Rating</span>
                        <span class="number3">8.9</span>
                        
                    </div>
                       
                   </div>


                   <div class="button mt-2 d-flex flex-row align-items-center">

                    <button class="btn btn-sm btn-outline-primary w-100">Chat</button>
                    <a href="<?php echo FRONT_ROOT ?>Guardian/ShowDisponibilidadView">
                           <button class="btn btn-sm btn-primary w-100 ml-2">Modificar Disponibilidad</button>
                       </a>

                       
                   </div>


                </div>

                    
                </div>
                
            </div>
             
         </div>