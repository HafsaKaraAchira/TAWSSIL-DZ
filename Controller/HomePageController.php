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

        public function getAnnonceSelection()
        {
            // Load configuration and static data
            Configuration::getInstance();

            // Retrieve the number of announcements to display from the session configuration
            $nbAnnonces = $_SESSION['configuration']['general']['nbVueAnnonce'] ;//?? 8; // Default to 8 if not set

            // Initialize the Annonce model
            $this->m = new Annonce();

            // Fetch the selected announcements based on the configured number
            $annonces = $this->m->annoncesSelectionQuery($nbAnnonces);

            // Return the fetched announcements
            return $annonces;
        }

        public function viewPage(){
            $slides = $this->getDiaporama() ;
            $annonces = $this->getAnnonceSelection() ;
            $this->v = new HomePageView($slides,$annonces);
            $this->v->view();
        }
    }
?>