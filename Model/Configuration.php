<?php
require_once(ROOT_PATH . '/Model/Query.php');

class Configuration
{
    // Singleton instance of the configuration
    private static $instance = null;

    // Private constructor to prevent direct instantiation
    private function __construct() {}

    // Public method to get the singleton instance
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->initialize();
        }
        return self::$instance;
    }

    // Initialize the configuration and load static data
    private function initialize()
    {
        if (!isset($_SESSION['configuration'])) {
            $_SESSION['configuration'] = array();

            // Load configuration data from the database
            $this->loadGeneralConfiguration();

            // Load static data
            $this->loadWilayas();
            $this->loadPoids();
            $this->loadVolumes();
        }
    }

    private function loadGeneralConfiguration()
    {
        // Fetch general configuration
        $query = new Query("SELECT * FROM `configuration` WHERE 1");
        $_SESSION['configuration']['general'] = $query->execute_query(PDO::FETCH_ASSOC)[0];
    }

    private function loadWilayas()
    {
        if (!isset($_SESSION['wilayas'])) {
            $query = new Query("SELECT WilayaID, WilayaCode, WilayaName FROM wilaya ORDER BY WilayaCode");
            $_SESSION['wilayas'] = $query->execute_query(PDO::FETCH_ASSOC);
        }
    }

    private function loadPoids()
    {
        if (!isset($_SESSION['poids'])) {
            $query = new Query("SELECT PoidsIntervalleID, MinPoids, MaxPoids FROM poidsintervalles ORDER BY MinPoids");
            $_SESSION['poids'] = $query->execute_query(PDO::FETCH_ASSOC);
        }
    }

    private function loadVolumes()
    {
        if (!isset($_SESSION['volumes'])) {
            $query = new Query("SELECT VolumeIntervalleID, MinVolume, MaxVolume FROM volumeintervalles ORDER BY MinVolume");
            $_SESSION['volumes'] = $query->execute_query(PDO::FETCH_ASSOC);
        }
    }
}
