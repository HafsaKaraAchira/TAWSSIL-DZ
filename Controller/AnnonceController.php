<?php 
    require_once('CommonController.php');
    require_once(root_path('Model/Annonce.php'));
    require_once(root_path('Model/Transaction.php'));
    require_once(root_path('View/AnnonceVue.php'));
    require_once(root_path('View/RechercheVue.php'));
    
    class AnnonceController extends CommonController
    {
        //private $id ;
        public function __construct($page){
            parent::__construct($page);
            $this->m = new Annonce() ;
        }

        public function __get($property){
            return $this->property;
        }

        public function __set($property, $value){
            $this->property = $value ;
        }

        public function getGeneralAnnonceInfos($id){
            $annonce=$this->m->AnnonceGeneralInfosQuery($id);
            return $annonce;
        }

        public function getAnnonceDetails($id){
            $detail=$this->m->AnnonceDetailsQuery($id);
            //var_dump($detail);
            return $detail;
        }

        public function getPossibleTranport($annonce,$depart,$arriv){
            $transport=$this->m->AnounceTransportCorrespondanceQuery($annonce,$depart,$arriv);
            return $transport;
        }

        public function doSugguestTransaction($transaction){
            $this->m = new Transaction();
            $this->m->addTransactionsQuery($transaction);
            header('Location: /?view=Annonce&action=AnnonceDetails&id='.$transaction['annonce']);
        }

        public function getAnnonce($id){
            return $this->getGeneralAnnonceInfos($id) ;
        }

        public function getRechercheResult($depart,$arriv){
            $result=$this->m->rechercheQuery($depart,$arriv);
            return $result;
        }

        public function doAddAnnonce($annonce){
            $this->m->addAnnonceQuery($annonce) ;
            header('Location:/?') ;
        }

        public function doArchiveAnnonce($annonce){
            $this->m->archiveAnnonceQuery($annonce) ;
            header('Location: /?view=Profile');
        }

        public function doModifierAnnonce($annonce){
            $this->m->UpdateAnnonceQuery($annonce) ;
            header('Location: /?view=Annonce&action=AnnonceDetails&id='.$annonce['id']);
        }


        /**
         * Handles the logic for rendering the "Annonce" view.
         *
         * @param int $id The ID of the annonce to display.
         * @return void
         */
        private function handleAnnonceView($id)
        {
            $annonceInfos = $this->getAnnonce($id);

            if ($annonceInfos !== null) {
                $annonceDetails = $this->getAnnonceDetailsForUser($id, $annonceInfos);
                $annonceTransports = $this->getAnnonceTransportsForUser($annonceInfos);

                $this->v = new AnnonceVue($annonceInfos, $annonceDetails, $annonceTransports);
                $this->v->view();
            } else {
                $this->redirectToHomeWithError("La page que vous avez demandée n'est pas trouvée !");
            }
        }

        /**
         * Retrieves the details of an annonce for the current user.
         *
         * @param int $id The ID of the annonce.
         * @param array $annonceInfos The general information of the annonce.
         * @return array|null The details of the annonce or null if not accessible.
         */
        private function getAnnonceDetailsForUser($id, $annonceInfos)
        {
            if (!empty($_SESSION['profile'])) {
                return $this->getAnnonceDetails($id);
            }
            return null;
        }

        /**
         * Retrieves the possible transports for the current user based on the annonce.
         *
         * @param array $annonceInfos The general information of the annonce.
         * @return array|null The possible transports or null if not accessible.
         */
        private function getAnnonceTransportsForUser($annonceInfos)
        {
            if (!empty($_SESSION['profile']) && $_SESSION['profile']['ProfileID'] === $annonceInfos['AnnonceUserID']) {
                return $this->getPossibleTranport(
                    $annonceInfos['AnnonceID'],
                    $annonceInfos['TransportGarantie'],
                    $annonceInfos['AnnoncePtDepart'],
                    $annonceInfos['AnnoncePtArrivee']
                );
            }
            return null;
        }

        /**
         * Handles the logic for rendering the search results view.
         *
         * @param array $id The search parameters (e.g., depart and arriv).
         * @return void
         */
        private function handleSearchView($id)
        {
            $result = $this->getRechercheResult($id['depart'], $id['arriv']);
            $this->v = new RechercheVue($result);
            $this->v->view();
        }

        /**
         * Redirects the user to the home page with an error message.
         *
         * @param string $message The error message to display.
         * @return void
         */
        private function redirectToHomeWithError($message)
        {
            echo <<<HTML
                <script type="text/javascript">
                    alert("$message");
                    window.location.href = "/?";
                </script>
            HTML;
            exit;
        }

        /**
         * Dynamically loads the view class file based on the view name.
         *
         * @param string $vueName The name of the view class to load.
         * @return void
         */
        private function loadViewClass($vueName)
        {
            $viewPath = root_path('View/' . $vueName . '.php') ;
            if (file_exists($viewPath)) {
                require_once($viewPath);
            } else {
                $this->redirectToHomeWithError("La vue demandée n'existe pas !");
            }
        }

         /**
         * Handles rendering the appropriate view based on the page and ID.
         *
         * @param int|string $id The ID of the resource to display (default: -1).
         * @return void
         */
        public function viewPage($id = -1)
        {
            $vueName = $this->page . 'Vue';
            $this->loadViewClass($vueName);

            if ($vueName === 'AnnonceVue') {
                $this->handleAnnonceView($id);
            } else {
                $this->handleSearchView($id);
            }
        }
    }//class

?>