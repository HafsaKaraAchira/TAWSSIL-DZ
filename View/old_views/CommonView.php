<?php
/**
 * Abstract class CommonVue
 * 
 * This class provides a common structure for rendering HTML pages in a web application.
 * It includes methods for generating common HTML elements such as headers, footers, 
 * navigation bars, and the main content area. It also handles user session-based 
 * customization of the interface.
 * 
 * Properties:
 * - $my_secret_key (protected): A secret key used internally (not currently utilized in the code).
 * - $username (protected): Stores the username of the logged-in user or defaults to 'anonymous'.
 * 
 * Methods:
 * - __get($property): Magic method to retrieve the value of a property.
 * - CommonHTMLOpening(): Outputs the opening HTML structure, including the <head> section and 
 *   a script to manage the display of user-specific elements based on session data.
 * - CommonHTMLEnclosure(): Outputs the closing HTML structure, including the </body> and </html> tags.
 * - CommonPageHeader(): Outputs the header section of the page, including the logo, title, and user action buttons.
 * - MenuNavBar(): Outputs the navigation bar with links to various pages of the application.
 * - contents(): Abstract method that must be implemented by subclasses to define the main content of the page.
 * - CommonFooter(): Outputs the footer section of the page with links to various pages.
 * - view(): Combines all the common elements (header, navigation bar, main content, footer) to render the full page.
 * 
 * Usage:
 * This class is intended to be extended by other classes that implement the `contents()` method
 * to define the specific content of a page. It provides a consistent structure for all pages in the application.
 */

abstract class CommonVue
{

    protected $my_secret_key = '3klmsd94mms.saeo44o!!3le';

    protected $username; //='anonymous' ;

    //public function __construct(){
    //    var_dump($_SESSION['profile']) ;
    //}
    public function __get($property)
    {
        return $this->property;
    }

    public function CommonHTMLOpening()
    {
        $this->username = !empty($_SESSION['profile']) ? $_SESSION['profile']['prenom'] : 'anonymous';
        //var_dump($this->username) ;
        echo "<!DOCTYPE html>
            <html>
                <head>
                    <meta charset='utf-8'>
                    <meta name='description' content='vtc transport site'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>VTC TRANSPORT</title>
                    <link rel='icon' href='./../Assets/img/logo.svg' type='image/x-icon'>
                    <script type ='text/javascript' src='./../Assets/lib/jquery-3.6.0.js' ></script>
                    <!-- <script type ='text/javascript' src='./../Vue/VueFormatter.js' ></script> -->
                    <link rel='stylesheet' href='./../Vue/styles.css' type='text/css'>
                    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.12.1/css/all.css' crossorigin='anonymous'>
                    <script>
                        let jq = jQuery.noConflict();
                        jq(document).ready(function() {
                            profile_state();
                        });//ready
                            
                    function profile_state(){    
                        var username = '" . $this->username . "' ;
                        //console.log(username);
                        if(username!=='anonymous'){
                            jq('header button#inscription').css('display','none');
                            jq('header button#connexion').css('display','none');
                            jq('header button#profile').css('display','block');
                            jq('header button#deconnecter').css('display','block');
                            jq('header').append('<h5>Bonjour " . $this->username . " !</h5>') ;
                        }
                    }// END OF profile_state()
                    </script>
                
                </head>
                <body>
            ";
    }

    public function CommonHTMLEnclosure()
    {
        echo <<<HTML
                </body>
                </html>
            HTML;
    }

    public function CommonPageHeader()
    {
        echo <<<HTML
            <header>
                <a href='/?view=PageAccueil'><img src='./../Assets/img/logo.svg' alt='logo'></a>
                <h1>VTC Transport de matériels et colis </h1>
                <div>
                    <button id='inscription' onclick='window.location=\"/?view=Inscription\"'' >Inscription</button>
                    <button id='connexion' onclick='window.location=\"/?view=Login\"' >Connexion</button>
                    <button id='profile' class='" . $this->username . "' onclick='window.location=\"/?view=Profile\"'' style='display:none;' >Profile</button>
                    <button id='deconnecter' onclick='window.location=\"/?action=Deconnecter&view=Login\"' style='display:none;' >Deconnecter</button>
                </div>
            </header>
            HTML;
    }

    public function MenuNavBar()
    {
        echo <<<HTML
            <nav>
                <a href='/?view=PageAccueil'> Accueil</a>
                <a href='/?view=Presentation'>Présentation</a>
                <a href='/?view=AllNews'>News</a>
                <a href='/?view=Inscription'>Inscription</a>
                <a href='/?view=Statistiques'>Statistiques</a>
                <a href='/?view=Contact'>Contact</a>
            </nav>
        HTML;
    }

    abstract public function contents();

    public function CommonFooter()
    {
        echo <<<HTML
            <footer>
                <a href='/?view=PageAccueil'> Accueil</a>
                <a href='/?view=Presentation'>Présentation</a>
                <a href='/?view=AllNews'>News</a>
                <a href='/?view=Inscription'>Inscription</a>
                <a href='/?view=Statistiques'>Statistiques</a>
                <a href='/?view=Contact'>Contact</a>
            </footer>
            HTML;
    }

    public function view()
    {
        $this->CommonHTMLOpening();
        $this->CommonPageHeader();
        $this->MenuNavBar();
        echo '<main>';
        $this->contents();
        echo '</main>';
        $this->CommonFooter();
        $this->CommonHTMLEnclosure();
    }
}
