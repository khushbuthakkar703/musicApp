<?php

namespace App\Traits;

use App\IdentifiedMusic;
use App\WithdrawalRequest;

trait IdentifiedMusicTrait {
    public function get_videos_to_pay($dj_user_id){
        $videos_to_pay = IdentifiedMusic::where('dj_id', $dj_user_id)
            ->where('paid', 1);
//            ->where('payments_records->status', IdentifiedMusic::no_action);

        return $videos_to_pay;
    }

    public function get_denied_videos($dj_user_id){
        $videos_declined = IdentifiedMusic::where('dj_id', $dj_user_id)
            ->where('paid', 1);
//            ->where('payments_records->status', IdentifiedMusic::denied);

        return $videos_declined;
    }

    public function deny_videos($identified_music_ids){
        IdentifiedMusic::whereIn('id', $identified_music_ids)
            ->update(['payments_records->status'=>IdentifiedMusic::denied]);
    }

    public function update_status($identified_music_ids, $status){
        if (is_string($identified_music_ids) || is_int($identified_music_ids)){

            return IdentifiedMusic::where('id', $identified_music_ids)
                ->update(['payments_records->status'=> (int)$status]);
        }

        return IdentifiedMusic::whereIn('id', $identified_music_ids)
            ->update(['payments_records->status'=>(int)$status]);

    }

    public function get_payable($dj_id, $wr_id){
        $dj_id = \App\Dj::find($dj_id)->user_id;

        return IdentifiedMusic::where('dj_id', $dj_id)
            ->where('paid', 1)
            ->where('payments_records->status', IdentifiedMusic::approved)
            ->where('payments_records->wr_id', (int) $wr_id)
            ->sum('payments_records->dj_earned_points');
    }

//    public function get_requested_amount($dj_id){
//        $dj_id = \App\Dj::find($dj_id)->user_id;
//
//        return IdentifiedMusic::where('dj_id', $dj_id)
//            ->where('paid', 1)
//            ->where('payments_records->status', IdentifiedMusic::withdraw_requested)
//            ->sum('payments_records->dj_earned_points');
//    }

//    public function get_probable_amount($dj_id)
//    {
//        $dj_id = \App\Dj::find($dj_id)->user_id;
//
//        return IdentifiedMusic::where('dj_id', $dj_id)
//            ->where('paid', 1)
//            ->where('payments_records->status', IdentifiedMusic::no_action)
//            ->sum('payments_records->dj_earned_points');
//    }

    public function get_videos_to_review($wr_id){
        $wr = WithdrawalRequest::find($wr_id);
        $dj_id = $wr->dj_id;
        $dj_id = \App\Dj::find($dj_id)->user_id;

        return IdentifiedMusic::where('dj_id', $dj_id)
            ->where('paid', 1)
            ->where('payments_records->wr_id', $wr->id);
    }

    public function get_requested_amount_in_wr($wr_id){
           return $this->get_videos_to_review($wr_id)
            ->sum('payments_records->dj_earned_points');
    }

}
