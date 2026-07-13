<?php
// pretty much the api controller for /Setting/QuietGet/ServiceHere/
// node.js service created, do not use this anymore

// Note from meditext to floof: i am keeping this and reutilizing it because of some accuracy reasons (and port occupation).
// i will be fair, it's more pratical running this inside PHP rather than having an extra node.js service doing the job.
// i may plan to make it as a Lavarel or any kinds of routing microservice in the future, but for now, this is fine.

namespace Roblox\Game;
use Roblox\Web\SecureAPI\APIKey;
use IncludeHelper;

class LegacyFFlagDeployer {
    private array $nameToJSONMapping = [ // mapping names. TODO: make those have their unique flags.
        'ClientSharedSettings' => 'ClientAppSettings.json',
        'ClientAppSettings' => 'ClientAppSettings.json',
        'AndroidAppSettings' => 'ClientAppSettings.json',
        'iOSAppSettings' => 'ClientAppSettings.json',
        'DurangoAppSettings' => 'ClientAppSettings.json',
        'UWPAppSettings' => 'ClientAppSettings.json',
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

    public function handleRequest(string $path = 'ClientAppSettings') {
        $this->authRequest();

        // who cares about readability? right????
        $namePath = trim((string)$path, ' \n\r\t\v\0/'); // changed some stuff in order to make it work with the new router.
        $namePath = htmlspecialchars($namePath);
        if (!isset($this->nameToJSONMapping[$namePath]))
            $this->returnTextResult('{}');

        $jsonName = $this->nameToJSONMapping[$namePath];
        $jsonPath = sprintf(self::BASEPATH, $jsonName);
        $jsonFile = IncludeHelper::getContents($jsonPath);

        $this->returnTextResult($jsonFile);
    }
}