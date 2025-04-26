<?php

/**
 * Generates a safe public URL for assets (img, css, js).
 *
 * @param string $path Relative path from the project root
 * @return string Full HTML-compatible path (e.g., /myproject/assets/img/logo.svg)
 */
function asset(string $path): string {
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * Returns the absolute filesystem path to a file/directory inside the project
 * @param string $path
 * @return string
 */
function root_path(string $path = ''): string {
    return ROOT_PATH . '/' . ltrim($path, '/');
}

/**
 * Generates a safe public URL for the application
 * @param string $path
 * @return string
 */
function url(string $path = ''): string {
    return APP_URL . '/' . ltrim($path, '/');
}

/**
 * redirects to a given URL
 * @param string $location
 * @return void
 */
function redirect(string $location): void {
    header("Location: " . url($location));
    exit;
}

/**
 * Checks if the request method is POST
 * @return bool
 */
function is_post(): bool {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Checks if the request method is PUT
 * @return bool
 */
function is_get(): bool {
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Checks if a given URL is internal (relative) or external (absolute).
 *
 * @param string $url The URL to check.
 * @return bool True if the URL is internal, false if it is external.
 */
function is_internal_url(string $url): bool {
    // If the URL is a valid absolute URL, it is external
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }
    // Check if the URL starts with '/' (internal) or does not match external patterns
    return strpos($url, '/') === 0 ||  !preg_match('/^www\./i', $url) || !preg_match('/^[\w.-]+\.[a-z]{2,}$/i', $url) ;
}