<?php

namespace App;
use Log;
use App\KafkaMessage;

class KafkaProducer
{
    //
	
    public static function produce($topic, $body){
		// $rk = new \RdKafka\Producer();
		// $rk->setLogLevel(LOG_DEBUG);
		// $rk->addBrokers("173.249.44.117:9092");
		// $conf = new \RdKafka\TopicConf();
		// $conf->set("message.timeout.ms", 10000);
		// $actualtopic = env('KAFKA_PREFIX','DEV_').$topic;
		// $topic = $rk->newTopic($actualtopic, $conf);

		// $topic->produce(RD_KAFKA_PARTITION_UA, 0, $body);
		// Log::debug($body);
	}

	public static function saveAndProduce($body){
		
		$message = new KafkaMessage();
		$message->message = json_encode($body);
		$message->save();
		$body['message_id'] = $message->id;

		$msgStr = json_encode($body);
		$message->message = $msgStr;
		$message->save();
		//self::produce($body["topic"], $msgStr);

	}
}
