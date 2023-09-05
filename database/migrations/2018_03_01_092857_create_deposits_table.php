    <?php
    
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    class CreateDepositsTable extends Migration
    {
        public function up()
        {
            Schema::create('deposits', function (Blueprint $table) {
                $table->increments('id');
                $table->string('campaign_uid');
                $table->string('transaction_id');
                $table->string('currency_code');
                $table->string('payment_status');
                $table->Integer('amount');
                $table->double('referral_amount_paid')->default(0);
                $table->timestamps();
            });
        }
        public function down()
        {
            Schema::drop("deposits");
        }
    }