<?php

namespace App\Controllers;

use App\View;

class FileController {
    public function upload() {
        // return  (new View('uploadfile' , ['pagetitle' => "the page title" , 'buttontitle' => 'submitting']))->render();
        return View::make('uploadfile' , ['pagetitle' => "the page title" , 'buttontitle' => 'submitting']);
    }

    public function download() {
        header('Content-Type: image/png');
        header('Content-Disposition: attachment;filename="image.png"');

        if(file_exists(STORAGE_PATH . '/imga.png'))
            readfile(STORAGE_PATH . '/imga.png');

    }

    public function storeFile() {
        /**
         * the file is uploaded temporary to /tmp folder as setted in php.ini as a default value
         *  
         * we need to move file from /tmp folder to storage folder 
         * 
         * we use global variable -- $_FILE -- to control uploading files and get data about files
         * 
         * php.ini : 
         * 
         * 1 file_uploads          -> to enable/disble uploading files
         * 2 upload_tmp_dir        -> to change tmp dir
         * 3 upload_max_filesize
         * 4 max_file_uploads      -> max number of files uploaded in on request 
         * 5 max_time_input        -> time to upload 
         */

        echo '<pre>';
        // var_dump($_FILES);

        move_uploaded_file($_FILES['receipt']['tmp_name'][0] , STORAGE_PATH . '/' . $_FILES['receipt']['name'][0]);
        move_uploaded_file($_FILES['receipt']['tmp_name'][1] , STORAGE_PATH . '/' . $_FILES['receipt']['name'][1]);


        echo '</pre>';
    }
}