<div class="modal-content" id="campaignData">
    <div class="modal-header" style="border-bottom: 0;">
        <h5 class="modal-title" style="font-size: 20px;">New Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: inherit;">
            <span style="font-size: 25px;padding-right: 10px;"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span>
            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-1" type="button" class="btn btn-success btn-circle"></a>
                    <p><small>Basic info</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"></a>
                    <p><small>Audio details</small></p>
                </div>
                <div class="stepwizard-step col-xs-4"> 
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"></a>
                    <p><small>Payment method</small></p>
                </div>
            </div>
        </div>
        <form method="POST" enctype="multipart/form-data" id="addCampaignForm">
            {{ csrf_field() }}
            <div class="setup-content" id="step-1">
                <h4 style="font-size:16px;margin-top: 40px;">Basic Information</h4>
                <div class="pt-4">
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Campaign name *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter campaign name" name="txtCampaingName" id="txtCampaingName" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Company name *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter company name" name="txtCompanyName" id="txtCompanyName" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Artist website *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="eg: https;//www.spinstatz.com" name="txtArtistWebsite" id="txtArtistWebsite" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <button class="btn nextBtn pull-right" type="button">Next <span>></span></button>
                </div>
            </div>
            
            <div class="setup-content" id="step-2">
                <h4 style="font-size:16px;margin-top: 40px;">Audio Details</h4>
                <div class="pt-4" style="height: 300px;overflow-y: scroll;">
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Song name *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter song name" name="txtSongName" id="txtSongName" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Release date *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="date" required="required" class="form-control add-campaign-form" placeholder="DD-MM-YYYY" name="txtReleaseDate" id="txtReleaseDate" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Upload audio file *</label>
                        <div class="col-xs-8 pl-0">
                            <div class="file-upload">
                                <input type="file" required="required" class="form-control add-campaign-form" placeholder="No file choosen" name="txtAudioFile" id="txtAudioFile" />
                            </div>
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Upload artwork image *</label>
                        <div class="col-xs-8 pl-0">
                            <div class="file-upload">
                                <input type="file" required="required" class="form-control add-campaign-form" placeholder="No file choosen" name="txtArtworkImg" id="txtArtworkImg" />
                            </div>
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">ISRC code *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter ISRC code" minlength="12" name="txtISRCCode" id="txtISRCCode" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">UPC code *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter UPC code" name="txtUPCName" id="txtUPCName" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Artist's name *</label>
                        <div class="col-xs-8 pl-0">
                            <input type="text" required="required" class="form-control add-campaign-form" placeholder="Enter artist name" name="txtArtistName" id="txtArtistName" autocomplete="off" />
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 pl-0">Select the genre (max 2) *</label>
                        @for($i=0; $i < count($musictypes); $i++)
                            <div class="col-xs-6 pl-0">
                                <input type="checkbox" name="musictype[]" class="genre-check" data-icheck value="{{$musictypes[$i]->id}}" required>
                                <label for="terms_and_conditions" class="icheck-label">{{$musictypes[$i]->name}}</label>
                            </div>
                        @endfor
                        <div class="col-xs-12 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                    </div>
                </div>
                <button class="btn prevBtn pull-left mt-4" type="button"><span><</span> Prev </button>
                <button class="btn nextBtn pull-right mt-4" type="button">Next <span>></span></button>
            </div>
            
            <div class="setup-content" id="step-3">
                <h4 style="font-size:16px;margin-top: 40px;">Payment method</h4>
                <div class="pt-4">
                    <span class="">Please select the amount you would like to deposit to your campaign. You will be able to adjust the amount DJs will earn each time they play your music from your Dashboard once your account is active.</span>
                    <div class="form-group mt-4  col-xs-12 pl-0">
                        <label class="control-label">Choose a plan *</label>
                        <div class="col-xs-8 pl-0">
                            <select class="form-control add-campaign-form" onchange="fnCalculateAmount(this.value)" required name="selectPlan" id="selectPlan">
                                <option value="">Select a plan</option>
                                <option value="20" {{ $newCampaignSelectedPackage == "demo" ? 'selected':'' }}>$20 (Demo Campaign)</option>
                                <option value="100" {{ $newCampaignSelectedPackage == "starter" ? 'selected':'' }}>$100 (Starter Campaign)</option>
                                <option value="500" {{ $newCampaignSelectedPackage == "standard" ? 'selected':'' }}>$500 (Standard Campaign)</option>
                                {{--<option value="1000">$1000</option>--}}
                                {{--<option value="2000">$2000</option>--}}
                                {{--<option value="3000">$3000</option>--}}
                                <option value="4000" {{ $newCampaignSelectedPackage == "career_boost" ? 'selected':'' }}>$4000 (Career Boost)</option>
                                {{--<option value="5000">$5000</option>--}}
                                {{--<option value="7000">$7000</option>--}}
                                {{--<option value="10000">$10000</option>--}}
                            </select>
                        </div>
                        <div class="col-xs-4 pl-0">
                            <span class="has-error-span" style="display: none;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 22px;"></i> <span style="margin-left: 10px;position: absolute;">You must enter this field.</span></span>
                        </div>
                        <input type="hidden" name="transaction_fee" id="hdn_transaction_fee">
                        <input type="hidden" name="amount" id="hdn_total_amount">
                        <input type="hidden" name="amount" id="hdn_amount">
                        <input type="hidden" name="region" value="{{$region}}">
                    </div>
                    <div class="form-group col-xs-12 pl-0">
                        <label class="control-label">Payment method *</label>
                        <div class="custom-control custom-radio" style="left: 14px;">
                            <input type="radio" class="custom-control-input" id="chkPaymentMethod" name="chkPaymentMethod" checked>
                            <label class="custom-control-label" for="defaultChecked">Paypal</label>
                        </div>
                        <img src="/img/images.png" class="pull-right" width="60" height="20">
                    </div>
                    <button class="btn prevBtn pull-left mt-3" type="button"><span><</span> Prev</button>
                    <button class="btn nextBtn proceedBtn pull-right  mt-3" type="button" onclick="saveCampaignData()">Proceed to payment</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-content" id="confirmPayment" style="display: none;">
    <div class="modal-header" style="border-bottom: 0;">
        <h5 class="modal-title" style="font-size: 20px;">Confirm Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: inherit;">
            <span style="font-size: 25px;padding-right: 10px;"><i class="fa fa-question-circle-o" aria-hidden="true"></i></span>
            <span aria-hidden="true" style="font-size: 30px;">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div>
            <h6>Order summary</h6>
        </div>
        <div>
            <span>Product name</span>
            <span class="pull-right product_name"></span>
        </div>
        <br>
        <div>
            <span>Amount</span>
            <span class="pull-right amount">$</span>
        </div>
        <br>
        <div>
            <span>Transaction fee</span>
            <span class="pull-right transaction_fee">$</span>
        </div>
        <hr style="margin-top: 15px;margin-bottom: 15px;">
        <div style="color: #93E5E5;font-weight: 600;">
            <span>Total</span>
            <span class="pull-right total">$</span>
        </div>
        <br>
        <div>
            <h6>Payment via</h6>
        </div>
        <div>
            <span><img src="/img/images.png" width="60" height="20"></span>
            <span class="pull-right">4012**********1234</span>
        </div>
    </div>
    <div class="modal-footer" style="border-top: 0px;">
        <button type="button" class="btn nextBtn pull-left" style="margin-right: 43%;" onclick="goBack()">Go back</button>
        <button type="button" class="btn proceedBtn pull-right" onclick="saveConfirmPayment()">Confirm Payment</button>
    </div>
</div>
<style>
    .btn.disabled, .btn[disabled], fieldset[disabled] .btn { pointer-events: none; }
    .genre-check { position: absolute; }
    .icheck-label { margin-left: 20px; }
    select.add-campaign-form option { color: #FFFFFF; }
    .proceedBtn.focus, .proceedBtn:focus, .proceedBtn:hover { color: #333 !important; }
    .file-upload {position: relative; width: 100%; height: 30px; }
    .file-upload:after {content: 'No file chosen'; font-size: 14px; position: absolute; top: 0; left: 0; background: #333333; padding: 17px 12px; /* display: block; */ width: calc(100% - 30px); pointer-events: none; z-index: 20; height: 20px; line-height: 2px; border-radius: 6px;color: #c0c0c0; }
    .file-upload:before {content: 'Choose File'; position: absolute; top: 0; 
    left: 175px; display: inline-block; color: #333333; font-weight: 500; z-index: 25; line-height: 28px; padding: 0 20px; pointer-events: none; border: 2px solid rgb(132, 255, 255) !important;border-radius: 20px !important;background: #78FFFF; }
    .file-upload input {opacity: 0; position: absolute; top: 0; right: 0; bottom: 0; left: 0; z-index: 99; height: 40px; margin: 0; padding: 0; display: block; cursor: pointer; width: 100%; }
    label {
        font-style: normal;
        font-weight: normal;
        font-size: 13px;
        line-height: 18px;
        display: flex;
        align-items: center;
        color: #FFFFFF;
    }
    .form-control.add-campaign-form{
        width: 300px;
        height: 34px;
        background: #333333;
        border: 1px solid #333333;
        border-radius: 6px;
    }
    .form-control:focus {
        width: 300px;
        height: 34px;
        background: #333333;
        border: 1px solid #333333;
        border-radius: 6px;
        color:#FFFFFF;
    }
    .proceedBtn {
        align-items: center;
        text-align: center;
        background: #93E5E5 !important;
        border-radius: 50px;
        color: #333333 !important;
        border: 1px solid #93E5E5 !important;
        padding: 8px 30px 8px 30px !important;
    }
    .nextBtn {
        align-items: center;
        text-align: center;
        background: #060606;
        border-radius: 50px;
        color: #93E5E5;
        border: 1px solid #93E5E5;
        padding: 8px 30px 8px 30px;
    }
    .prevBtn {
        align-items: center;
        text-align: center;
        background: #060606;
        border-radius: 50px;
        color: #93E5E5;
        border: 1px solid #93E5E5;
        padding: 8px 30px 8px 30px;
    }
    .btn.focus, .btn:focus, .btn:hover {
        color: #93E5E5;
    }
    .stepwizard-step p {
    margin-top: 10px;
    color:#FFFFFF;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 12px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 70%;
    height: 3px;
    background-color: #ccc;
    z-index: 0;
    left: 80px;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 24px;
    height: 24px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
.stepwizard-step .btn-success {
    color: #000;
    background-color: #93E5E5;
    border-color: #93E5E5;
}
.btn-success.disabled:hover, .btn-success[disabled]:hover, fieldset[disabled] .btn-success:hover, .btn-success.disabled:focus, .btn-success[disabled]:focus, fieldset[disabled] .btn-success:focus, .btn-success.disabled.focus, .btn-success[disabled].focus, fieldset[disabled] .btn-success.focus {
    color: #000;
    background-color: #93E5E5;
    border-color: #93E5E5;
}
.btn-success p { 
    color:#93E5E5 !important;
}
.modal-dialog {
    margin-top:15%
}
.modal-content {
    width: 560px;
    /* height: 545px; */
    border-radius: 10px;
    background: #060606;
    margin-top:15%
}
.custom-control-input:checked~.custom-control-label::before {
    color: #fff;
    border-color: #93E5E5;
    background-color: #93E5E5;
}
.custom-radio .custom-control-input:checked~.custom-control-label::after {
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e);
}
.custom-control-label::after {
    position: absolute;
    top: .25rem;
    left: -2.5rem;
    display: block;
    width: 2rem;
    height: 2rem;
    content: "";
    background: no-repeat 50%/50% 50%;
}
.custom-control-label::before {
    position: absolute;
    top: .25rem;
    left: -2.5rem;
    display: block;
    width: 2rem;
    height: 2rem;
    pointer-events: none;
    content: "";
    background-color: #fff;
    border: #adb5bd solid 1px;
}
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #C4C4C4; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
.has-error-span {
    color: #FA3131;
}
.has-error label {
    color: #FFFFFF !important;
}
.has-error .form-control {
    border-color: #FA3131 !important;
}
</style>
<script>
    $(document).ready(function(){
        var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');
        allPrevBtn = $('.prevBtn');


        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

            $(".has-error-span").css("display", "none");
            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                    $(".has-error-span").css("display", "block");
                    console.log(curInputs[i]);
                }
            }

            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });

        allPrevBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;
            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');

        $('.genre-check').on('change',function () {
            if($('input[type=checkbox]:checked').length >= 3){
                this.checked = false;
            }
        });
        // $("#txtReleaseDate").datepicker({
        //     format: 'yyyy-mm-dd',
        //     autoclose: true,
        // })
    });

    function fnCalculateAmount(amount) {

        var fixedPer = 4.4;
        var transactionFee = ((amount * fixedPer) / 100).toFixed(0);
        var totalAmount = amount * 1 + transactionFee * 1;

        //$("#transaction_fee").text('$' + transactionFee);
        $("#hdn_transaction_fee").val(transactionFee);

        //$("#total_amount").text('$' + totalAmount);
        $("#hdn_total_amount").val(totalAmount);
        $("#hdn_amount").val(amount);
    }

    function goBack() {
        $("#campaignData").css('display', 'inline-flex');
        $("#confirmPayment").css('display', 'none');
    }

    function saveCampaignData() {
        $("#campaignData").css('display', 'none');
        $("#confirmPayment").css('display', 'block');
        if($("#hdn_amount").val() == 20) {
            var product_name = 'Demo Campaign';
        } else if($("#hdn_amount").val() == 100) {
            var product_name = 'Starter Campaign';
        } else if($("#hdn_amount").val() == 500) {
            var product_name = 'Standard Campaign';
        } else {
            var product_name = 'Career Boost';
        }
        $(".product_name").html(product_name);
        $(".amount").html('$'+$("#hdn_amount").val());
        $(".transaction_fee").html('$'+$("#hdn_transaction_fee").val());
        $(".total").html('$'+$("#hdn_total_amount").val());
    }
    
    function saveConfirmPayment() {
        var genres = [];
        $('[name="musictype[]"]:checked').each(function() {
            genres.push($(this).val());
        });
        var formData = new FormData();
        formData.append('campaign_name',$('#txtCampaingName').val());
        formData.append('company_name',$('#txtCompanyName').val());
        formData.append('artist_website',$('#txtArtistWebsite').val());
        formData.append('song_title',$('#txtSongName').val());
        formData.append('release_date',$('#txtReleaseDate').val());
        formData.append('isrc',$('#txtISRCCode').val());
        formData.append('upc',$('#txtUPCName').val());
        formData.append('musictype',genres);
        formData.append('artist_name',$('#txtArtistName').val());
        formData.append('image',$('#txtArtworkImg')[0].files[0]);
        formData.append('audio',$('#txtAudioFile')[0].files[0]);
        formData.append('amount',$('#hdn_amount').val());
        formData.append('is_flag','1');
        $.ajax({
            type: "POST",
            url: '/payment/paypal',
            //data: { amount: $("#hdn_amount").val(), campaign_name: $('#txtCampaingName').val(), is_flag: '1' },
            data: formData,
            processData: false,
            contentType: false,
            success : function(res){
                window.location.href=res;
            }
        });
    }
</script>