
<div class="ch-container">
    <div class="row">
        <?php $this->load->module('sidebar')->index();?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
    <div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Configuration</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Configuration</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                    <div class="col-xs-12">
                                        <form action="<?=base_url()?>setup/configuration_edit" method="post" id="editConfigurationForm" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityName">Company Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityName" name="charityName" value="<?=$configuration->cherity_name?>"  class="form-control" placeholder="Charity Name" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityAddress">Company Address</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityAddress" name="charityAddress" value="<?=$configuration->address?>" class="form-control" placeholder="Charity Address" />
                                                </div>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityPhone">Company Phone</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityPhone" name="charityPhone" value="<?=$configuration->phone?>" class="form-control" placeholder="Charity Phone" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityEmail">Company Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityEmail" name="charityEmail" class="form-control" value="<?=$configuration->email?>" placeholder="Charity Email" />
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityFax">Company Fax</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityFax" name="charityFax"  class="form-control" value="<?=$configuration->fax?>" placeholder="Charity Fax" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityWebsite">Company Website</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityWebsite" name="charityWebsite" class="form-control" value="<?=$configuration->website?>" placeholder="Charity Website" />
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityLogo">Company Logo</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="charityLogo" name="charityLogo"  class="form-control" placeholder="Charity Logo" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <img src="<?=base_url()?>img/<?=$configuration->logo?>" width="350" height="350" class="img-thumbnail">
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charitySMSUser">SMS User</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charitySMSUser" name="charitySMSUser" value="<?=$configuration->smsuser?>" class="form-control" placeholder="Charity SMS user" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charitySMSPassword">SMS password</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charitySMSPassword" name="charitySMSPassword" value="<?=$configuration->smspass?>" class="form-control" placeholder="Charity SMS password" />
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityEmailSenderName">Email Sender Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityEmailSenderName" name="charityEmailSenderName" value="<?=$configuration->emailsendername?>" class="form-control" placeholder="Email sender name" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityEmailSenderID">Email Sender ID</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityEmailSenderID" name="charityEmailSenderID" value="<?=$configuration->emailsenderaddress?>" class="form-control" placeholder="Email sender name" />
                                                </div>
                                                </div>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityOpeningBalanceBank">Opening Balance In Bank</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityOpeningBalanceBank" name="charityOpeningBalanceBank" value="<?=$configuration->opbankbalance?>"  class="form-control" placeholder="Opening Balance In Bank" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityOpeningBalanceCash">Opening Balance In Cash</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="charityOpeningBalanceCash" name="charityOpeningBalanceCash" value="<?=$configuration->opcashbalance?>" class="form-control" placeholder="Opening Balance In Cash" />
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charitySignatureImage">Signature Image</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="charitySignatureImage" name="charitySignatureImage" class="form-control" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                        <img src="<?=base_url()?>assets/image/setUpwindow/<?=$configuration->signatureimage?>" width="350" height="350" class="img-thumbnail">
                                                </div>
                                                </div>

                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charitySignatureText">Signature Text</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" id="charitySignatureText" name="charitySignatureText"  class="form-control" placeholder="Signature Text"><?=$configuration->signaturetext?></textarea>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="charityApprovalDisabled">Approval Disabled</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="charityApprovalDisabled" name="charityApprovalDisabled" class="form-control" value="1"<?php if($configuration->approval_disabled =='1') echo "checked='checked'"?>/>
                                                </div>
                                                </div>
                                            </div>


                                            <hr>
                                            <!-- <legend>{donorid}{donornamefirst} {donornamemiddle} {donornamelast} {donoraddress} {city} {postcode}{cellnumber} {phone} {title} {email} </legend> -->
                
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="dnRegistrationEmailText">Email</label>
                                                <div class="col-md-9">
                                                    <textarea rows="5" type="text" id="dnRegistrationEmailText" name="dnRegistrationEmailText"  class="form-control" placeholder="Signature Text"><?=$configuration->dnregistrationemailtext?></textarea>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="dnRegistrationEmail">Email to Customer at Customer Registration</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="dnRegistrationEmail" name="dnRegistrationEmail" class="form-control" value="1" <?php if($configuration->registration_email =='1') echo "checked='checked'"?>/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="dnRegistrationSMSText">SMS</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" rows="5"  id="dnRegistrationSMSText" name="dnRegistrationSMSText"  class="form-control" placeholder="Signature Text"><?=$configuration->dnregistrationsmstext?></textarea>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="dnRegistrationSMS">SMS to Customer at Customer Registration</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox"  id="dnRegistrationSMS" name="dnRegistrationSMS" class="form-control" value="1" <?php if($configuration->registration_sms =='1') echo "checked='checked'"?>/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="eventEmailText">Email</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" rows="5"  id="eventEmailText" name="eventEmailText"  class="form-control" placeholder="Signature Text"><?=$configuration->eventemailtext?></textarea>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="eventEmail">Email at event intimation</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="eventEmail" name="eventEmail" class="form-control" value="1" <?php if($configuration->event_email =='1') echo "checked='checked'"?>/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="eventSMSText">SMS</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" rows="5"  id="eventSMSText" name="eventSMSText"  class="form-control"><?=$configuration->eventsmstext?></textarea>
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="eventSMS">SMS at event intimation</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="eventSMS" name="eventSMS" class="form-control" value="1" <?php if($configuration->event_sms =='1') echo "checked='checked'"?>/>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="donationEmailText">Email</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" rows="5"  id="donationEmailText" name="donationEmailText"  class="form-control" placeholder="Signature Text"><?=$configuration->donationemailtext?></textarea>
                                                    <!-- {donationid} {donationamount} {event} -->
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="donationEmail">Email to Customer at Order status</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="donationEmail" name="donationEmail" class="form-control" value="1"<?php if($configuration->donation_email =='1') echo "checked='checked'"?> />
                                                     
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="donationSMSText">SMS</label>
                                                <div class="col-md-9">
                                                    <textarea type="text" rows="5"  id="donationSMSText" name="donationSMSText"  class="form-control"><?=$configuration->donationsmstext?></textarea>
                                                     <!-- {donationid} {donationamount} {event} -->
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="donationSMS">SMS to Customer at Order status</label>
                                                <div class="col-md-9">
                                                    <input type="checkbox" id="donationSMS" name="donationSMS" class="form-control" value="1" <?php if($configuration->donation_sms =='1') echo "checked='checked'"?>/>
                                                    
                                                </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="vat_percent">VAT %</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="vat_percent" name="vat_percent" value="<?=$configuration->vat_percent?>"  class="form-control" placeholder="VAT %" />
                                                </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-md-3 control-label" for="vat_no">VAT No.</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="vat_no" name="vat_no" value="<?=$configuration->vat_no?>" class="form-control" placeholder="VAT No." />
                                                </div>
                                                </div>
                                            </div>
                                            
                                            </div>
                                            <div class="form-group pull-right">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="hdnConfigurationId" id="hdnConfigurationId" value="<?=$configuration->config_id?>">
                                                    <input type="submit" name='submit' value="Save Configuration" class="btn btn-primary"/>
                                                </div>
                                            </div>                                
                                        </form> 
                                    </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                
            </div>
        </div>
    </div>
</div>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

<?php $this->load->module('footer')->index(); ?>