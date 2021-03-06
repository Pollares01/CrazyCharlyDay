<?php

namespace crazy\vue;

use Slim\Slim;

class VueGestionRole {

    private $selector;
    private $html;
    private $gestion_role;
    /**
     * @var string
     */
    private $URLbootstrapCSS;
    /**
     * @var string
     */
    private $URLbootstrapJS;
    /**
     * @var Slim|null
     */
    private $app;
    private $home;
    /**
     * @var string
     */
    private $URLcomptes;
    /**
     * @var string
     */
    private $URLcreneaux;
    /**
     * @var string
     */
    private $URLconnexion;

    public function __construct($sel,$liste) {
        $this->app = Slim::getInstance();
        $this->home= $this->app->urlFor('afficher_le_menu');
        $this->gestion_role = $liste;
        $this->selector = $sel;
        $this->URLbootstrapCSS = $this->app->request->getRootUri() . '/public/css/bootstrap.css';
        $this->URLbootstrapJS = $this->app->request->getRootUri() . '/public/js/boostrap.min.js';
        $this->home= $this->app->urlFor('afficher_le_menu');
        $this->URLcomptes = $this->app->urlFor('afficher_les_comptes');
        $this->URLcreneaux = $this->app->urlFor('ajout');
        $this->URLconnexion = $this->app->urlFor('se_connecter');
        $this->html = <<<END
<html lang="fr">
                    <head>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                      <meta name="description" content="">
                      <meta name="author" content="">
                      <title>CoBoard</title>
                      <!-- Bootstrap core CSS -->
                      <link rel="stylesheet" href="$this->URLbootstrapCSS">
                      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
                    </head>
                    <body>
                      <!-- Navigation -->
                       <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
                        <div class="container">
                          <a class="navbar-brand" href="$this->home">CoBoard</a>
                          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                              <li class="nav-item active">
                                <a class="nav-link" href="$this->home">Home
                                  <span class="sr-only">(current)</span>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href=$this->URLcomptes>Comptes</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href=$this->URLcreneaux>Créneaux</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href=$this->URLconnexion>Se connecter</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </nav>
                      <!-- Page Content -->
                      
        <blockquote class="blockquote text-center">
        <p class="mb-0 mt-5">Liste de la gestion des rôles</p>
      </blockquote>
END;
    }

    public function listeGestionRole() {
        $res = '<div class="d-flex p-5">';
        foreach ($this->gestion_role as $values) {
            $image = "img/" . $values->IDuser . ".jpg"; 
            $res = $res . <<<END
            <div class="card mr-5 ml-5" style="width: 18rem;">
            <span class="border border-danger">
            <img class="card-img-top" src="$image" alt="Profil user">
            </span>
            <span class="border border-info">
            <div class="card-body">
            <ul class="list-group list-group-flush w-100 align-items-stretch">
              <p class="card-text text-primary">IDrole : $values->IDrole</p>
              <p class="card-text text-success">IDuser : $values->IDuser</p>
              <p class="card-text text-danger">Cycle : $values->cycle</p>
              <p class="card-text text-warning">Crenaux : $values->Crenaux h</p>
              </ul>
              </div>
              </span>
          </div>
END;
        }
        $this->html = $this->html .  $res .'</div>';
    }

    public function render() {
        if ($this->selector == "liste_gestion_role") {
            $this->listeGestionRole();
        }
        $this->html = $this->html . <<<END
        </div>
        <!-- Bootstrap core JavaScript -->
        <script src="$this->URLbootstrapJS"></script>
</body>
</html> 
END;
echo ($this->html);
    }
    
}