<?php
/**
 * Abstract class CommonView
 * 
 * This class provides a common structure for rendering HTML pages in a web application.
 * It includes methods for generating common HTML elements such as headers, footers, 
 * navigation bars, and the main content area. It also handles user session-based 
 * customization of the interface.
 * 
 * Properties:
 * - $my_secret_key (protected): A secret key used internally (not currently utilized in the code).
 * - $username (protected): Stores the username of the logged-in user or defaults to 'anonymous'.
 * - $pageScripts (protected): An array to store page-specific scripts.
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
 * to define the specific content of a page. 
 * It provides a consistent structure for all pages in the application.
 */

abstract class CommonView
{

    protected $my_secret_key = '3klmsd94mms.saeo44o!!3le';
    protected $username; //='anonymous' ;
    protected $pageScripts = []; // Add this property to store page-specific scripts

    public function __get($property)
    {
        return $this->property;
    }

    public function CommonHTMLOpening()
    {
        // Pass the $pageScripts variable to the opening.php file
        $pageScripts = $this->pageScripts;
        include root_path('View/partials/opening.php');
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
        include root_path('View/partials/header.php');
    }

    public function MenuNavBar()
    {
        include root_path('View/partials/navbar.php');
    }

    abstract public function contents();

    public function CommonFooter()
    {
        include root_path('View/partials/footer.php');
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