<?php
// pretty much the api controller for /Setting/QuietGet/ServiceHere/
// TODO: create a node.js service that handles this, much better than this.

namespace Roblox\Game;
use Roblox\Web\SecureAPI\APIKey;
use IncludeHelper;

class FFlagDeployer {
    private array $nameToJSONMapping = [
        'ClientSharedSettings' => 'ClientAppSettings.json'
    ];
    private string $apiKey;
    private APIKey $authHandler;

    private const BASEPATH = '/json/%s';

    function __construct() {
        $this->apiKey = $_ENV['CLIENT_APIKEY'];
        $this->authHandler = new APIKey($this->apiKey);
    }

    private function returnTextResult(string $result) {
        header('Content-Type: application/json');
        exit($result);
    }

    private function authRequest() {
        try {
            $authResult = $this->authHandler->processRequest();
        } catch (\Exception $e) {
            $this->returnTextResult('{"errormsg": "' . $e->getMessage() .'"}');
        }

        if ($authResult == $this->authHandler::INVAILD)
            $this->returnTextResult('{}');
    }

    public function handleRequest() {
        $this->authRequest();

        // who cares about readability? right????
        $namePath = trim((string)$_GET['path'], ' \n\r\t\v\0/');
        $namePath = htmlspecialchars($namePath);
        if (!isset($this->nameToJSONMapping[$namePath]))
            $this->returnTextResult('{}');

        $jsonName = $this->nameToJSONMapping[$namePath];
        $jsonPath = sprintf(self::BASEPATH, $jsonName);
        $jsonFile = IncludeHelper::getContents($jsonPath);

        $this->returnTextResult($jsonFile);
    }
}