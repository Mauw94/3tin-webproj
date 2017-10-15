<?php

namespace view;

class JsonView implements View
{
    public function show(array $data)
    {
        header('Content-Type: application/json');

        if (isset($data['toShow'])) {
            $showJson = $data['toShow'];
            echo json_encode($showJson);
        } else {
            echo '{Nothing to show.}';
        }
    }

}