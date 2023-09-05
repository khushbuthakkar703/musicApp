<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Monolog\Logger;
use Monolog\Handler\StdoutHandler;


class KafkaConsumer extends Controller
{
	public function consume(){

		date_default_timezone_set('PRC');
		
		
		// Create the logger
		//$logger = new Logger('my_logger');
		// Now add some handlers
		//$logger->pushHandler(new StdoutHandler());

		$config = \Kafka\ConsumerConfig::getInstance();
		$config->setMetadataRefreshIntervalMs(10000);
		$config->setMetadataBrokerList('127.0.0.1:9092');
		$config->setGroupId('test');
		$config->setBrokerVersion('0.10.1.0');
		$config->setTopics(['audio_added, audio_played']);
		//$config->setOffsetReset('earliest');
		$consumer = new \Kafka\Consumer();
		//$consumer->setLogger($logger);
		$consumer->start(function($topic, $part, $message) {
			var_dump($message);
		});
		
	}

	

	public function ctestphp(){
		return phpinfo();
	}

}
