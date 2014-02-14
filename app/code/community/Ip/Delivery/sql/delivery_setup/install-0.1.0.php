<?php
$this->startSetup();
$this->run("
    DROP TABLE IF EXISTS {$this->getTable('delivery/zips')};
    CREATE TABLE {$this->getTable('delivery/zips')} (
      `zip_id` int(11) NOT NULL auto_increment,
      `zip_code` int(5) NULL,
      `rate` decimal(6,2) NULL,
      PRIMARY KEY  (`zip_id`)
    );
");
$this->endSetup();
