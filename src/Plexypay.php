<?php

namespace Plexypay;

use GuzzleHttp\Client;
use Plexypay\Utils;

class Plexypay {

    private $config = [
        /* env: prod | test | dev */
        'env' => 'test',
        'private_key' => ''
    ];

    private $httpClient = null;

    public function __construct(array $config = []) {
        $this->config = array_replace($this->config, $config);
        $this->httpClient = new Client([
            'base_uri' => Utils::get_api_url($this->config['env'])
        ]);
    }

    public function create_payment_session($data) {
        return $this->post('payment-sessions', $data);
    }

    public function is_valid_signature($data, $signature) {
        return Utils::is_valid_signature($this->config['private_key'], $data, $signature);
    }

    public function refund_transaction($transaction_id, $amount) {
        $body = isset($amount) ? ['amount' => floatval( $amount ) ] : [];
        return $this->post("payments/$transaction_id/refund", $body);
    }

    public function capture_transaction($transaction_id, $amount) {
        $body = isset($amount) ? ['amount' => floatval( $amount ) ] : [];
        return $this->post("payments/$transaction_id/capture", $body);
    }

    public function cancel_transaction($transaction_id) {
        return $this->post("payments/$transaction_id/cancel");
    }

    private function post($url, $data = null) {
        $options = [
            'headers' => [
                'Authorization' => $this->config['private_key']
            ]
        ];
        
        if (isset($data)) {
            $options['json'] = $data;
        }

        $raw_response = $this->httpClient->request('POST', $url, $options);

        return json_decode($raw_response->getBody(), true);
    }
}
