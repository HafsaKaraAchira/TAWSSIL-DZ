<?php
    require_once('CommonView.php');
    require($_SERVER['DOCUMENT_ROOT'].'/View/CadreVue.php');
    class RechercheVue extends CommonView
    {
        private $result ;

        public function __construct($result){
            $this->result = $result ;
        }

        public function rechercheResult(){

            echo "<section id='result'>
                    <h2>Resultat de Recherche</h2> 
                " ;   //".length($this->result)."
            foreach ($this->result as $result) {
                $cadre = new CadreVue();
                echo $cadre->AnnonceCadre($result) ;
            }
            echo "</section>";
        }

        public function contents(){
            $this->rechercheResult();
        }
    }
?>