<?php

class dashboard {
    public  $name               = '',
            $version            = '',
            $assets_folder      = '',
            $banner             = '',
            $title              = '',
            $main_nav           = array();


    public function __construct($name = '', $version = '', $assets_folder = '') {
        // Set Template's name, version and assets folder
        $this->name                 = $name;
        $this->version              = $version;
        $this->assets_folder        = $assets_folder;
    }

    public function build_nav($nav_header = false, $nav_header_icons = false, $print = true) {
        // Clean navigation HTML
        $this->nav_html = '';

        // Build navigation
        $this->build_nav_array($this->main_nav, $nav_header, $nav_header_icons);

        // Print or return navigation
        if ($print) {
            echo $this->nav_html;
        } else {
            return $this->nav_html;
        }
    }
}