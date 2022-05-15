<?php

namespace Src\Controller;

use Src\Classes\TVSeries;

class TVSeriesController {
    private $db;
    private $requestMethod;
    private $queries;

    private $tvSeriesGateway;

    public function __construct($db, $requestMethod, $queries = [])
    {
        $this->db = $db;
        $this->queries = $queries;
        $this->requestMethod = $requestMethod;

        $this->tvSeriesGateway = new TVSeries($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getTVSeries($this->queries);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    private function getTVSeries ($query) {
        $result = $this->tvSeriesGateway->getNextTVSeries($query);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        if (! $result) {
            $response['body'] = json_encode([]);
        } else {
            $response['body'] = json_encode($result);
        }
        return $response;
    }
}