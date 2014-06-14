<?php

/**
 * Action controller class
 *
 * Create a Controllername class as a subclass
 * of Flooer_Controller class and save as a Controllername.php
 * into the controllers directory of an application.
 *
 * A method defined as an httpmethodActionname() is the action
 * of the controller and accessible like this:
 *
 * GET /
 * route to Index::getIndex()
 * GET /index
 * route to Index::getIndex()
 * because an Index controller and an Index action is default route.
 *
 * GET /index/note/id/1
 * route to Index::getNote()
 *
 * POST /index/note
 * route to Index::postNote()
 *
 * PUT /index/note/id/1
 * route to Index::putNote()
 *
 * DELETE /index/note/id/1
 * route to Index::deleteNote()
 *
 * ****************
 * Flooer Framework accept the request method emulation on POST method
 * with 'X-HTTP-Method-Override' request header or 'method' request parameter.
 * ****************
 *
 * If a requested controller/action does not exist or an error happened,
 * Flooer Framework try to call the action of an error controller.
 * Please see application/controllers/Error.php file.
 */
class Index extends Flooer_Controller
{

    /**
     * Application resources
     *
     * Remembering Bootstrap.php,
     * The bootstrapper will set an application resources
     * and those resources are available in the class properties
     * of an action controller class like this:
     *
     * $this->autoload, $this->dispatch,
     * $this->request, $this->response,
     * $this->cookie, $this->session, $this->server,
     * $this->view, $this->gettext, $this->log
     */

    /**
     * Constructor
     *
     * A construct() method is an alternative constructor
     * and called before requested action.
     */
    public function construct()
    {
        // Create a notes table
        if (!isset($this->db->notes)) {
            $this->db->notes = array(
                'id' => 'INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT',
                'timestamp' => 'CHAR(19) NOT NULL',
                'text' => 'TEXT NOT NULL'
            );
        }

        // Make an instance of the model class
        // but the same as $this->db->notes
        require_once 'models/notes.php';
        $this->model = new notes($this->db);
    }

    /**
     * Destructor
     *
     * A destruct() method is an alternative destructor
     * and called after requested action.
     */
    public function destruct()
    {
    }

    /**
     * Get index of a notes
     */
    public function getIndex()
    {
        // Fetch the rowset data and assign to view
        $this->view->notes = $this->model->fetchRowset('ORDER BY timestamp DESC');
        // Pre-render a part of content for layout
        $this->view->content = $this->view->render('index/index.html');
    }

    /**
     * Alias of postNote()
     */
    public function postIndex()
    {
        $this->postNote();
    }

    /**
     * Get a note
     */
    public function getNote()
    {
        // Fetch the row data and assign to view
        if ($this->request->id
            && isset($this->model->{$this->request->id})
        ) {
            $this->view->note = $this->model->{$this->request->id};
            $this->view->content = $this->view->render('index/note.html');
            return;
        }

        // Error
        $this->response->setStatus(404);
        throw new Flooer_Exception('Page Not Found', LOG_NOTICE);
    }

    /**
     * Post a note
     */
    public function postNote()
    {
        // Insert a new row
        $this->model->new = array(
            // This key name (new) is ignored
            // because the primary key column is auto increment
            // and the same key name does not exist in the column.
            'timestamp' => date('Y-m-d H:i:s'),
            'text' => $this->request->text
        );

        // Redirect to the top page
        $this->response->redirect($this->server->baseUri);
    }

    /**
     * Put a note
     */
    public function putNote()
    {
        // Update the row data
        $row = $this->model->{$this->request->id};
        $row->timestamp = date('Y-m-d H:i:s');
        $row->text = $this->request->text;
        $this->model->{$this->request->id} = $row;

        // Redirect to the top page
        $this->response->redirect($this->server->baseUri);
    }

    /**
     * Delete a note
     */
    public function deleteNote()
    {
        // Delete the row data
        unset($this->model->{$this->request->id});

        // Redirect to the top page
        $this->response->redirect($this->server->baseUri);
    }

    /**
     * About a feature of view
     */
    public function getAbout()
    {
        // Set a view file
        $this->view->setFile('about.txt');
    }

}

// Next, please see application/views/* files.
