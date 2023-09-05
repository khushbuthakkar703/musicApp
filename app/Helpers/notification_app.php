<?php


namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class notification_app {

	function __construct(){
		$this->adminReceivedMesssages=array();
		$this->adminReceivedMesssages['paymentRequest'] = array('subject'=>'admin','message'=>'paymentRequest');
		$this->adminReceivedMesssages['adveritesement'] = array('subject'=>'campign','message'=>'Adveritesement created');
		$this->adminReceivedMesssages['adveritesement_approve'] = array('subject'=>'approve','message'=>'Adveritesement Approve');
		$this->adminReceivedMesssages['adveritesement_denied'] = array('subject'=>'denied','message'=>'Adveritesement Denied');
		$this->adminReceivedMesssages['campign_added'] = array('subject'=>'Campign add','message'=>'New Campign Added');
		$this->adminReceivedMesssages['dj_withdraw_request'] = array('subject'=>'Dj Withdraw','message'=>'Dj Payment Requested');
		$this->adminReceivedMesssages['dj_withdraw_denied'] = array('subject'=>'Dj Withdraw','message'=>'Dj Withdraw Money Denied');
		$this->adminReceivedMesssages['dj_withdraw_faild'] = array('subject'=>'Dj Withdraw','message'=>'Dj Withdraw Money Faild');
		$this->adminReceivedMesssages['dj_withdraw'] = array('subject'=>'Dj Withdraw','message'=>'Dj Payment Successfully');
		$this->adminReceivedMesssages['dj_notification'] = array('subject'=>'Music Evennt','message'=>'New Event has been created.');
		$this->adminReceivedMesssages['campign_low_balence'] = array('subject'=>'Campaingn low balance','message'=>'Campaingn balance is low.');
		$this->adminReceivedMesssages['djman_event_status'] = array('subject'=>'Campaingn low balance','message'=>'Campaingn balance is low.');
		$this->adminReceivedMesssages['campign_music_request'] = array('subject'=>'Campign Music Request','message'=>'Campign Music Request.');
	}
	

	public function onlynotification($notification) {
		
		DB::table('notifications')->insertGetId($notification);

	}

	public function emailnotification($email) {

		mail();

	}

	public function emailandnotification($notification,$email) {

	}	
}