<?php

/**
 * Bootstrapper class
 *
 * To configure an application,
 * create a Bootstrap class as a subclass of Flooer_Application_Bootstrap class
 * and save as a Bootstrap.php into an application directory.
 *
 * The class method defined as an initName() is called automatically
 * in the bootstrapping of an application.
 *
 * Flooer_Application_Bootstrap class have predefined methods:
 *
 * initDispatch(), initRequest(), initResponse(),
 * initCookie(), initSession(), initServer(),
 * initView(), initGettext(), initLog()
 *
 * You can override those methods to customize the default configuration.
 */
class Bootstrap extends Flooer_Application_Bootstrap
{

    /**
     * Initialize a database connection object
     */
    public function initDb()
    {
        // Make a connection to the database
        $db = new Flooer_Db(array(
            'dsn' => 'sqlite:'
                . $this->getApplication()->getConfig('baseDir')
                . '/database/database.sqlite3'
        ));

        // Set to the application resource
        $this->getApplication()->setResource('db', $db);
    }

    /**
     * Initialize an HTTP request object
     */
    public function initRequest()
    {
        // Initialize the object and set to the resource
        parent::initRequest();

        // Get the resource
        $request = $this->getApplication()->getResource('request');

        // Set a new URI mapping rules
        $request->setUriMapRules(
            array(
                array(
                    // /id
                    '^([0-9]+)$',
                    'controller=index&action=note&id=$1'
                ),
                array(
                    // The same as the default rule
                    // /controller/action/key/value/key/value...
                    '^([^/]+)/?([^/]*)/?(.*)$',
                    'controller=$1&action=$2&params=$3',
                    'params'
                )
            )
        );

        // URI mapping
        $request->mapUri();
    }

    /**
     * Initialize a session object
     */
    public function initSession()
    {
        parent::initSession();

        // If you want to start a session
        //$this->getApplication()->getResource('session')->start();
    }

    /**
     * Initialize a server and execution environment information object
     */
    public function initServer()
    {
        parent::initServer();
    }

    /**
     * Initialize a view object
     */
    public function initView()
    {
        parent::initView();
        $view = $this->getApplication()->getResource('view');

        // Pre-assign a content
        $view->title = 'Example app';
        $view->encoding = $this->getApplication()->getConfig('encoding');
        $view->baseUri = $this->getApplication()->getResource('server')->baseUri;
    }

    /**
     * Initialize a gettext and locale information setting object
     */
    public function initGettext()
    {
        parent::initGettext();
        $gettext = $this->getApplication()->getResource('gettext');

        // Set locale information
        switch ($this->getApplication()->getResource('request')->getAcceptLanguage(false)) {
            case 'ja':
                $gettext->setLocale('ja_JP.UTF-8');
                break;
            case 'en':
                $gettext->setLocale('en_US.UTF-8');
                break;
            default:
                break;
        }

        // Setup
        $gettext->setup();
    }

}

// Next, please see application/controllers/* files.
