    <div class="messages mb-20">
            <?php 
                $messages = $this->messenger->getMessages();
                if(!empty($messages)){
                    foreach($messages as $message){?>
                    <div class="message between-flex rad-10 type-<?= $message[1] ?>">
                        <p><?= $message[0] ?></p>
                        <a href=""><i class="fa-sharp fa-solid fa-circle-xmark"></i></a>
                    </div>
            <?php 
                    }
                }
            ?>  
    </div>