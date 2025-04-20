<?php

class BaseController
{
    public function view($path, $data = [])
    {
        extract($data); // extract variables from the data array to be used in the view
        //require_once "../app/views/{$path}.php"; // include the view file
        require_once __DIR__ . '/../views/' . $path . '.php'; // include the view file
    }


    public function redirect($url)
    {
        header("location: " . BASE_URL . '/' . ltrim($url, '/')); // redirect to the specified path
        exit; // terminate the script after redirection
    }

    public function setFlash($key, $message)
    {
        $_SESSION['flash'][$key] = $message; // set a flash message in the session
    }

    public function getFlash($key)
    {
        if (isset($_SESSION['flash'][$key])) {
            $meg = $_SESSION['flash'][$key]; // get the flash message from the session
            unset($_SESSION['flash'][$key]); // remove it from the session after retrieving it
            return $meg; // return the message
        }
        return null; // return null if no message is set for the key
    }

    public function requireAuth()
    {

        if (!isset($_SESSION['user'])) {
            $this->setFlash('error', 'You must be logged in to access this page.');
            $this->redirect('?action=loginForm'); // redirect to the login page if not authenticated
        }
    }
}
