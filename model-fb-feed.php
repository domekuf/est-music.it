<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/credential.php'; /*$cred*/

class FbFeed
{
    static public function get($uri) {
        global $cred;
        $fb = new Facebook\Facebook($cred);

        $requestPage = $fb->request('GET', $uri);

        $batch = [
            'page' => $requestPage
        ];
        try {
            $responses = $fb->sendBatchRequest($batch);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $result;
        foreach ($responses as $key => $response) {
            if ($response->isError()) {
                $e = $response->getThrownException();
                echo 'Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
                echo 'Graph Said: ' . "\n\n";
                var_dump($e->getResponse());
            } else {
                $result = json_decode($response->getBody(), TRUE);
            }
        }
        return $result;
    }
}
