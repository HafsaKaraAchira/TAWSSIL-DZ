<?php
require_once root_path('View/CommonView.php');
// require_once root_path('Vue/CadreVue.php');

class HomePageView extends CommonView
{
    private $slides;
    private $annonces;

    public function __construct($slides, $annonces)
    {
        $this->slides = $slides;
        $this->annonces = $annonces;
    }

    public function diaporama()
    {
        $slides = $this->slides; // Assign the slides to a local variable
        include root_path('View/partials/diaporama.php'); // Include the partial
    }


    public function contents()
    {
        $this->diaporama(); // Render the diaporama

        // include root_path('View/partials/diaporama.php');
        // include root_path('View/pages/search.php');
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
