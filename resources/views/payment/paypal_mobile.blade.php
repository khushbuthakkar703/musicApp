<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content spin_videov2">
    @if (session('status') != false)
        <div class="alert alert-success">
            {{ session('alert') }}
        </div>
    @else
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif
    <div class="container">

        <div class="row">
            
            <form class="form-horizontal" method="POST" action="{{ route('campaignpaymentmobile', [$mc_id]) }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="amount" class="col-md-4 control-label">Amount</label>
                    <input type="hidden" name="region" value="{{$region}}">
                    <div class="col-md-6">
                        <select id="amount" type="number" class="form-control"
                                name="actual_amount"
                                onchange="fnCalculateAmount(this.value)"
                                required>
                            <option value="">Select</option>
                            <option value="100">$100</option>
                            <option value="250">$250</option>
                            <option value="500">$500</option>
                            <option value="1000">$1000</option>
                            <option value="2000">$2000</option>
                            <option value="3000">$3000</option>
                            <option value="4000">$4000</option>
                            <option value="5000">$5000</option>
                            <option value="7000">$7000</option>
                            <option value="10000">$10000</option>
                        </select>

                        @if ($errors->has('amount'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                        @endif

                    </div>
                </div>
                <div class="form-group">

                    <label for="amount" class="col-md-4 control-label">Transaction Fee</label>

                    <div class="col-md-6">
                        <div style="margin-top: 7px;"><span id="transaction_fee">-</span></div>

                        <input type="hidden" name="transaction_fee" id="hdn_transaction_fee">

                    </div>
                </div>

                <div class="form-group">

                    <label for="amount" class="col-md-4 control-label">Total Amount</label>

                    <div class="col-md-6">
                        <div style="margin-top: 7px;"><span id="total_amount">-</span></div>

                        <input type="hidden" name="amount" id="hdn_total_amount">

                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            PAY
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>    
    <script type="text/javascript">
        $(document).ready(function () {
            $("#amount").change(function () {

            });

            $("#spin_rate").change(function () {
                $('#amount').val($('#spin_rate').val() * $('#count').val());
            });

            $("#count").change(function () {
                $('#amount').val($('#spin_rate').val() * $('#count').val());
            });
        });

        /**
         *
         * @param amount
         */
        function fnCalculateAmount(amount) {

            var fixedPer = 4.4;
            var transactionFee = ((amount * fixedPer) / 100).toFixed(0);
            var totalAmount = amount * 1 + transactionFee * 1;

            $("#transaction_fee").text('$' + transactionFee);
            $("#hdn_transaction_fee").val(transactionFee);

            $("#total_amount").text('$' + totalAmount);
            $("#hdn_total_amount").val(totalAmount);
        }
    </script>
