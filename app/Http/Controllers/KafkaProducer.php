<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StdoutHandler;


class KafkaProducer extends Controller
{
	
	public function produce1(){
		$rk = new \RdKafka\Producer();
		$rk->setLogLevel(LOG_DEBUG);
		//$rk->addBrokers("vmi178532.contaboserver.net:19092,vmi178532.contaboserver.net:29092,vmi178532.contaboserver.net:39092");
		$rk->addBrokers("74.208.131.129:9092");
		$conf = new \RdKafka\TopicConf();
		$conf->set("message.timeout.ms", 10000);

		$topic = $rk->newTopic("audio_played", $conf);

		for ($i = 0; $i < 10; $i++) {
		    $topic->produce(RD_KAFKA_PARTITION_UA, 0, '{"source_app_id" : "website","created_at" : "2006-01-02T15:04:05.999999-07:00","topic": "audio_added","payload" : {"user_id" : 1,"campaign_id" : 2,"audio_id" : '.'aa'.', "audio_link" : "http://75.98.175.45:8080/video/44-beatknockinradio@gmail.com-1525486902-video.webm"}');
		    $rk->poll(0);
		}

		 while ($rk->getOutQLen() > 0) {
		     $rk->poll(1);
		 }
	}

	public function produceMissed(){

		$missedMessages = \App\KafkaMessage::where('consumed',0)->get();

	    foreach($missedMessages as $missedMessage){
	    	$messageStr = $missedMessage->message;
	    	$message = json_decode($messageStr, TRUE);
	    	$topic = $message['topic'];

	    	\App\KafkaProducer::produce($topic, $messageStr);

	    }

	    return $missedMessages->count(). " FInished";
	}

}
