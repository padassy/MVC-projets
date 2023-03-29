<?php
# debug with file's name
# echo __FILE__;
# var_dump($_SESSION);

if (isset($_GET['disconnect'])) {
    // si déconnexion renvoie true
    if (deconnect()) {
        // redirection
        header("Location: ./");
        exit();
    }

// on veut rapidement activer ou désactiver un article depuis l'accueil de l'admin    
}elseif(isset($_GET['postVisible'],$_GET['id'])
    &&ctype_digit($_GET['postVisible'])
    &&ctype_digit($_GET['id'])
    ){
    $postId = (int) $_GET['id'];
    $postVisible = (int) $_GET['postVisible'];

    if (postAdminUpdateVisible($connectPDO, $postId, $postVisible)) {
        header("Location: ./?m=L'article dont l'id est $postId a été modifié");
        exit();
    } else {
        header("Location: ./?m=Problème lors de la modification de l'article!");
        exit();
    }

// on veut supprimer un post    
}elseif(isset($_GET['deletePost'])&&ctype_digit($_GET['deletePost'])){

    $postId = (int) $_GET['deletePost'];

    if(postAdminDeleteById($connectPDO,$postId)){
        header("Location: ./?m=L'article dont l'id est $postId a été supprimé");
        exit();
    }else{
        header("Location: ./?m=Problème lors de la modification de l'article!");
        exit();
    }

    
// accueil    
}else{
    // appel due la méthode (fonction) modèle PostModel pour afficher tous les articles SANS restrictions
    $postAll = postAdminHomepageAll($connectPDO);
    // on compte le nombre d'articles
    $postCount = count($postAll);
    // appel de la vue de l'accueil
    include "../view/privateView/privateHomepageView.php";
}