<?php

use Dom\HTMLElement;

require_once root_path('View/CommonView.php');
// require_once root_path('Vue/CadreVue.php');

class HomePageView extends CommonView
{
    private $slides;
    private $annonces;

    public function __construct($slides, $annonces)
    {
        $this->pageScripts = [ // Define the scripts for the home page
            'Assets/js/dz-map.js', // Include dz-map.js first
            'Assets/js/reverse.js', // Include reverse.js after dz-map.js
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

    public function announce_selection()
    {
        include root_path('View/partials/announce_selection.php');
    }

    public function add_announce_form()
    {
        include root_path('View/partials/add_announce_form.php');
    }

    public function How_to_button()
    {
        echo <<<HTML
            <div class="how-to-button-container text-center my-10">
                <a href='?view=Presentation' class="btn-secondary">Comment cela fonctionne</a>
            </div>
        HTML;
    }

    public function contents()
    {
        $this->diaporama(); // Render the diaporama
        $this->search(); // Render the search form
        $this->announce_selection(); // Render the selection
        
        // if user is logged in, show the add announcement form
        if (!empty($_SESSION['profile'])) {
            $this->add_announce_form(); // Render the add announcement form
        } else {
            echo <<<HTML
                <div class="info">
                    <i class="fas fa-exclamation-circle info-icon"></i>
                    <span>Veuillez vous connecter pour ajouter une annonce...</span>
                </div>
            HTML;
        }

        $this->How_to_button(); // Render the "How to" button
    }

}
