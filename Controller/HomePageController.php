<?php 
    require_once(root_path('Controller/CommonController.php'));
    require_once(root_path('Model/Diaporama.php'));
    require_once(root_path('Model/Annonce.php'));
    require_once(root_path('View/HomePageView.php'));

    class HomePageController extends CommonController
    {
        public function __construct($page){
            parent::__construct($page);
        }

        public function getDiaporama(){
            $this->m = new Diaporama() ;
            $slides = $this->m->DiaporamaQuery();
            return $slides ;
        }

        public function getAnnonceSelection(){
            //var_dump(Configuration::getConfiguration());
            // Configuration::getConfiguration() ;
            // Load configuration and static data
            Configuration::getInstance();
            $nbAnnonces = (int)$_SESSION['configuration']['general']['nbVueAnnonce'] ;
            //var_dump($nbAnnonces);
            $this->m = new Annonce() ;
            $annonces = $this->m->annoncesSelectionQuery($nbAnnonces);
            return $annonces ;
        }

        public function viewPage(){
            $slides = $this->getDiaporama() ;
            $annonces = []; //$this->getAnnonceSelection() ;
            $v = new HomePageView($slides,$annonces);
            $v->view();
        }
    }
?>