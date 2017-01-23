<?php
namespace kushki\tests\inttests\lib;
use kushki\lib\KushkiConstant;
use kushki\lib\KushkiCurrency;
use kushki\lib\KushkiEnvironment;
use kushki\lib\RequestHandler;

/**
 * Created by IntelliJ IDEA.
 * User: lmunda
 * Date: 19/04/16
 * Time: 17:13
 */
require_once dirname(__FILE__) . '/TokenRequestBuilder.php';
class TokenHelper {

    public static function getValidTokenTransaction($merchantId, $amount) {
        $cardParams = array(
            "name" => "John Doe",
            "number" => "4017779991118888",
            "expiry_month" => "12",
            "expiry_year" => "21",
            "cvv" => "123",
            "amount" => $amount
        );
        return self::requestToken($merchantId, $cardParams, KushkiCurrency::USD);
    }

    public static function getValidTokenTransactionColombia($merchantId, $amount) {
        $cardParams = array(
            "name" => "John Doe",
            "number" => "4005580000050003",
            "expiry_month" => "12",
            "expiry_year" => "18",
            "cvv" => "130",
            "amount" => $amount
        );
        return self::requestToken($merchantId, $cardParams, KushkiCurrency::COP);
    }

    public static function requestToken($merchantId, $cardParams, $currency) {
        $tokenRequestBuilder = new TokenRequestBuilder($merchantId, $cardParams, KushkiEnvironment::TESTING, $currency);
        $request = $tokenRequestBuilder->createRequest();
        $requestHandler = new RequestHandler();
        return $requestHandler->call($request);
    }
}
