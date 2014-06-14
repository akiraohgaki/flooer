<?php

/**
 * Error controller class
 *
 * Create an Error class as a subclass
 * of Flooer_Controller class and save as an Error.php
 * into the controllers directory of an application.
 *
 * A catchError() method is the action of an error controller
 * and called when thrown the exception of Flooer_Exception.
 *
 * If an error controller/action does not exist or an error happened again,
 * Flooer Framework will show a default error page.
 */
class Error extends Flooer_Controller
{

    /**
     * Application resources
     *
     * The same resources as an action controller class
     * and a resource for exception are available.
     *
     * $this->exception
     */

    /**
     * Action for error handling
     */
    public function catchError()
    {
        // Assign a content to view
        $this->view->title = 'Uh oh';
        $this->view->message = $this->exception->getMessage();
        $this->view->content = $this->view->render('error/error.html');
    }

}

// Next, please see application/views/* files.
