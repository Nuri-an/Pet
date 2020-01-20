<?php

class Config {
    public  $name               = '',
            $version            = '',  
            $assets_folder      = '';

    public function __construct($name = '', $version = '', $assets_folder = '') {
            // Set Template's name, version and assets folder
            $this->name                 = $name;
            $this->version              = $version;
            $this->assets_folder        = $assets_folder;
    }

    public function get_js($asset_js) {
        echo "<script src=\"$this->assets_folder/$asset_js\"></script>\n";
    }
}