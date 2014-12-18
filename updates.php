<?php

date_default_timezone_set('UTC');

echo json_encode(array(
  "identifier" => "ExLauncher",
  "branchs" => array(
    array(
      "name" => "public",
      "updates" => array(
        array(
          "id" => 1,
          "name" => "Premiere MAJ",
          "description" => "Update for testing the exLauncher system",
          "date" => date("m.d.y"),
          "required" => "true",
          "files" => array(
            array(
              "path" => "https://www.dropbox.com/s/f91sjrwofxxqe61/ddraw.rar?dl=1",
              "method" => "unzip"
            ),
          ),
        ),

        array(
          "id" => 2,
          "name" => "Deuxieme MAJ",
          "description" => "Update for testing the exLauncher system",
          "date" => date("m.d.y"),
          "required" => "true",
          "files" => array(
            array(
              "path" => "https://www.dropbox.com/s/swj80rz6a4ari73/guyrunner-java-master.zip?dl=1",
              "method" => "unzip"
            ),
          ),
        ),
      ),
    ),
  ),
));
