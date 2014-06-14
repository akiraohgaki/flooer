<?php

/**
 * Model class as a subclass of Flooer_Db_Table
 */
class notes extends Flooer_Db_Table
{

    /**
     * Constructor
     */
    public function __construct(&$db)
    {
        // Call the parent constructor first.
        parent::__construct($db);

        // Set a table name, the default is a class name.
        //$this->setName('notes');

        // Set a table name prefix, the default is null.
        //$this->setPrefix(null);

        // Set a table columns, the default is '*' (All).
        //$this->setColumns('*');

        // Set a primary key, the default is 'id'.
        //$this->setPrimary('id');

        // Set a primary key inserting option, the default is false.
        //$this->setPrimaryInsert(false);
    }

}
