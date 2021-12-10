<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'GuestBook.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Message.php';
$errors=null;
$succes= false;
//creation de l'objet guestBook
$guestBook=new GuestBook(__DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR. 'messages');
 
// les champs sont ils remplies ??
if (isset($_POST['username']) && isset($_POST['message'])) {
    //creation de l'objet message
    // echo('l objet est bien cree a la ligne 8');
     $message=new Message($_POST['username'],$_POST['message']);
    //  echo('on fait le var_dump du message de la ligne 16 ');
    // var_dump($message);
    // // le message est il valide ?
    if ($message->isValid()){
        $succes=true; // flag pour la suite
                
        $guestBook->addMessage($message); // encodage fait avec 
        $_POST=[]; // on vide les infos pour ne plus le faire apparaitre dans le formulaire
    }else { // non alors on devra afficher une erreur ???
        $errors=$message->getErrors();
        
        // var_dump($errors['error']);
    }      
}
// on arrive ici on va afficher les messages contenus dans le fichier avec 'decode'
$messages= $guestBook->getMessages();
$title="Livre d'or";
require 'elements/header.php';
?>
<title>Document</title>
</head>

<body>
    <div class="container">
        <?php if (!empty($errors)) :?>
        <!-- affichage dans une div du message d'invalidite du formulaire-->
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
        <?php endif ?>
        <!-- affichage dans une div du message de success du formulaire-->
        <?php if ($succes) :?>
        <div class="alert alert-success">
            Merci pour votre message
        </div>
        <?php endif ?>
        <form action="index.php" METHOD="POST">
            <h1>Livre d'or</h1>

            <div class="form-group">
                <input type="text" placeholder="Entrez votre pseudo" class="form-control" name="username">
            </div>

            <div class="form-group">
                <textarea class="form-control" id="message" name="message"
                    placeholder="Entrez votre message"></textarea>
            </div>
            <button class="w-100 btn btn-lg btn-primary" id="bouton" type="submit">Postez</button>

        </form>
        <!-- Affichage des messages -->
        <?php if (!empty($messages)) :?>
        <h1 class="mt-4">Vos messages</h1>
        <?php endif ?>
        <?php  foreach($messages as $message):  ?>
        <?= $message->toHTML() ?>
        <?php endforeach ?> -->
    </div>


    <?php
  require 'elements/footer.php';
  ?>