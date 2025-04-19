<?php 
    require_once(ROOT_PATH.'/Model/Query.php');
    class Diaporama
    {
        public function DiaporamaQuery(){
            $query = new Query(
                "SELECT image.ImageLink , 
                        slides.SlideLink 
                FROM slides 
                JOIN image 
                ON slides.ImageID = image.ImageID 
                ORDER BY slides.SlideID ASC
                "
            ) ;
            return $query->execute_query(PDO::FETCH_ASSOC) ;
        }
        
    }
?>