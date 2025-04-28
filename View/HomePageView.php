<?php
require_once root_path('View/CommonView.php');
// require_once root_path('Vue/CadreVue.php');

class HomePageView extends CommonView
{
    private $slides;
    private $annonces;

    public function __construct($slides, $annonces)
    {
        $this->pageScripts = [ // Define the scripts for the home page
            'Assets/js/dz-map-hover.js',
            'Assets/js/reverse.js',
        ];
        $this->slides = $slides;
        $this->annonces = $annonces;
    }

    public function diaporama()
    {   
        // Extract the slides variable to pass to the daiaporama view
        $slides = $this->slides; 
        include root_path('View/partials/diaporama.php'); // Include the partial
    }

    public function search()
    {
        include root_path('View/partials/search.php');
    }

    public function contents()
    {
        $this->diaporama(); // Render the diaporama
        $this->search(); // Render the search form
    
        
        // include root_path('View/pages/selection.php');

        // if (!empty($_SESSION['profile'])) {
        //     include root_path('View/pages/annonce_form.php');
        // }

        // include(root_path('View/pages/page_accueil_button.php'));
        // include(root_path('View/pages/page_accueil_scripts.php'));
    }

    // public function view()
    // {
    //     $this->CommonHTMLOpening();
    //     $this->CommonPageHeader();
    //     $this->MenuNavBar();
    //     echo '<main>';
    //     $this->diaporama(); // Render the diaporama
    //     // $this->contents();
    //     echo '</main>';
    //     $this->CommonFooter();
    //     $this->CommonHTMLEnclosure();
    // }

}
