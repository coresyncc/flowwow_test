<?php

namespace app\controllers;


use app\interfaces\ExchangeRatesApi;
use yii\web\Controller;
use yii\web\Response;

class ExchangeController extends Controller
{
    protected ExchangeRatesApi $api;
    public function __construct($id, $module, ExchangeRatesApi $api, $config = [])
    {
        $this->api = $api;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): Response
    {
        try {
            $response = $this->api->getLatest($this->request->get('base', 'USD'));
            return $this->asJson($response);
        } catch (\Exception $e) {
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
            ])->setStatusCode($e->getCode());
        }
    }
}
