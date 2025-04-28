<?php
require_once(root_path('Model/Configuration.php'));
require_once(root_path('Model/Query.php'));

/**
 * Abstract class CommonController
 * 
 * This class serves as a base controller for all other controllers in the application.
 * It provides common functionality such as rendering images and defining the structure
 * for child controllers.
 */
abstract class CommonController
{
    /**
     * @var mixed $v View object associated with the controller
     */
    protected $v;

    /**
     * @var mixed $m Model object associated with the controller
     */
    protected $m;

    /**
     * @var string $page The current page being handled by the controller
     */
    protected $page;

    /**
     * Constructor for the CommonController
     * 
     * @param string $page The name of the page being handled
     */
    public function __construct($page)
    {
        $this->page = $page;
        // Load configuration and static data
        Configuration::getInstance();
    }

    /**
     * Loads static data into session variables
     * 
     * This method checks if certain static data is already stored in session variables.
     * If not, it queries the database and stores the data in the session.
     */
    private function loadStaticData()
    {
        
    }

    /**
     * Renders an image from the server
     * 
     * This method serves an image file from the server to the client. It determines
     * the MIME type of the image and sends the appropriate headers.
     * 
     * @param string $link The relative path to the image file
     */
    public function viewImage($link)
    {
        // Clear any existing output buffers to prevent corrupting the image output
        if (ob_get_level()) {
            ob_end_clean();
        }

        // Construct the full path to the image file
        $imagePath = ROOT_PATH . '/Assets/img/' . rawurldecode($link);

        // Check if the image file exists
        if (file_exists($imagePath)) {
            // Determine the MIME type of the image
            $mimeType = mime_content_type($imagePath);

            // Send appropriate headers for the image
            header('Content-Type: ' . $mimeType);
            header('Content-Length: ' . filesize($imagePath));

            // Output the image content
            readfile($imagePath);
            exit;
        } else {
            // If the image file does not exist, send a 404 response
            http_response_code(404);
            exit;
        }
    }

    /**
     * Abstract method for rendering a page
     * 
     * This method must be implemented by child classes to handle rendering
     * specific pages.
     */
    abstract public function viewPage();
}
