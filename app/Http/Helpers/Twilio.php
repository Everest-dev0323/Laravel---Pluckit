<?php

namespace App\Http\Helpers;

use Twilio\Rest\Client as TwilioClient;


class Twilio {

    private static $objTwilioTokenApiCredential;
    private static $messageSid = '';
    private static $objApiCredential;
    private static $objApiCompanyNumber = '';
    private static $twillioExp = '';

    private static function allCredential() {
        self::$objApiCredential = "AC5a6cd959624a1da179ec1119fe79644b";
        self::$objTwilioTokenApiCredential = "81b1afeeefc2d2ed54c8e518dcf48049";
        self::$objApiCompanyNumber = "+61488855997";
    }
	
    /**
     * send message .
     *
     */
	 //+61423291960
    private static function sendText($number = '', $msg = '') {
		$valuedata = self::allCredential();
        
        $sid = self::$objApiCredential;
        $token = self::$objTwilioTokenApiCredential;
		$client = new TwilioClient($sid, $token);
		 try {
            $message = $client->messages
            ->create($number, // to
            array(
            "body" => $msg,
            "from" => self::$objApiCompanyNumber,
            )
            );
            return self::$messageSid = $message->sid;
        } catch (\Twilio\Exceptions\RestException $e) {
			return self::$twillioExp = array(
            'Error' => array('error_code' => $e->getStatusCode(), 'msg' => $e->getMessage())
            );
        }
    }

    /**
     * check sid  Exists .
     *
     */
    private static function sidDoesNotExists() {
        return array(
        'Error' => array('error_code' => 404, 'msg' => 'Sid Does not Exists')
        );
    }


    /**
     * check number  Exists .
     *
     */
    private static function numberDoesNotExists() {
        return array(
        'Error' => array('error_code' => 404, 'msg' => 'Number Does not Exists')
        );
    }

    /**
     * that will call getCompanyFromNumber getCompanySid and return api data.
     */
    public static function call($toNumber, $msg) {
        $valuedata = self::allCredential();
		
        if (!empty(self::$objApiCredential)) {
				if (!empty($toNumber)) {
					 self::sendText($toNumber, $msg);
					
                    if (!empty(self::$twillioExp)) {
                        return self::$twillioExp;
                    } else {
                        return self::$messageSid;
                    }
                } else {
                    return self::numberDoesNotExists();
                }
           
        } else {
            return self::sidDoesNotExists();
        }
    }

}
