<?php

namespace view;

class JsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        if (isset($data['toShow'])) {
            $showJson = $data['toShow'];
            echo json_encode($showJson);
        } else {
            echo '{Nothing to show.}';
        }
    }

    public function error(\Exception $e){
        header("HTTP/1.0 ".$e->getCode()." Internal Server Error");
        print('Error: ' . $e->getCode());
    }

}