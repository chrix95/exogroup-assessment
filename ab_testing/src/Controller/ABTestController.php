<?php

namespace Src\Controller;

use Exads\ABTestData;

class ABTestController {
    private $requestMethod;
    private $queries;

    public function __construct($requestMethod, $queries = [])
    {
        $this->queries = $queries;
        $this->requestMethod = $requestMethod;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->handleABTest();
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

    private function handleABTest () {
        // get random number between 1 and 3
        $randomNumber = rand(1, 3);
        $result = $this->getData($randomNumber);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        if (! $result) {
            $response['body'] = json_encode([]);
        } else {
            $response['body'] = json_encode($result);
        }
        return $response;
    }

    private function getData(int $promoId): array
    {
        $abTest = new ABTestData($promoId);
        $promotion = $abTest->getPromotionName();
        $designs = $abTest->getAllDesigns();
        return [$promotion];
        return array_map(function ($item, $promoId) {
            return $item;
        }, $designs, [$promoId]);
    }
}