<?php


namespace crazy\controller;


use Slim\Slim;

class VueCompte
{
    /**
     * @var Slim|null
     */
    private $app;
    /**
     * @var string
     */
    private $URLbootstrapCSS;
    /**
     * @var string
     */
    private $URLbootstrapJS;
    /**
     * @var string
     */
    private $URLcomptes;
    /**
     * @var string
     */
    private $home;
    /**
     * @var string
     */
    private $URLcreneaux;
    /**
     * @var string
     */
    private $URLconnexion;

    /**
     * VueCompte constructor.
     * @param $user
     */
    public function __construct()
    {
        $this->app = Slim::getInstance();
        $this->URLbootstrapCSS = $this->app->request->getRootUri() . '/public/css/bootstrap.css';
        $this->URLbootstrapJS = $this->app->request->getRootUri() . '/public/js/boostrap.min.js';
        $this->URLcomptes = $this->app->urlFor('afficher_les_comptes');
        $this->home= $this->app->urlFor('afficher_le_menu');
        $this->URLcreneaux = $this->app->urlFor('ajout');
        $this->URLconnexion = $this->app->urlFor('se_connecter');
    }

    public function render(){
        $main = "<html lang=\"en\">
                    <head>
                      <meta charset=\"utf-8\">
                      <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
                      <meta name=\"description\" content=\"\">
                      <meta name=\"author\" content=\"\">
                      <title>CoBoard</title>
                      <!-- Bootstrap core CSS -->
                      <link rel=\"stylesheet\" href=\"$this->URLbootstrapCSS\">
                      <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
                    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
                    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
                    </head>
                    <body>";
        $finMain = " </body>
        </html> ";
        $nav = " <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark static-top\">
                        <div class=\"container\">
                          <a class=\"navbar-brand\" href=\"$this->home\">CoBoard</a>
                          <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                            <span class=\"navbar-toggler-icon\"></span>
                          </button>
                          <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">
                            <ul class=\"navbar-nav ml-auto\">
                              <li class=\"nav-item active\">
                                <a class=\"nav-link\" href=\"$this->home\">Home
                                  <span class=\"sr-only\">(current)</span>
                                </a>
                              </li>
                              <li class=\"nav-item\">
                                <a class=\"nav-link\" href=$this->URLcomptes>Comptes</a>
                              </li>
                              <li class=\"nav-item\">
                                <a class=\"nav-link\" href=$this->URLcreneaux>Créneaux</a>
                              </li>
                              <li class=\"nav-item\">
                                <a class=\"nav-link\" href=$this->URLconnexion>Se connecter</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </nav>";
        echo $main . $nav . $this->afficherPageCompte() . $finMain;
    }

    public function afficherPageCompte(){
        if (isset($_SESSION['user_connected'])){
            $res = "</br> Vous êtes connecté sur le compte : " . $_SESSION['user_connected']['nom'];
        }else{
            $res = "Vous n'avez pas réussi à vous connecter";
        }
        return $res;
    }
}