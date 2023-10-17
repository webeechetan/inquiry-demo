<style type="text/css">
	html,body{
	  margin: 0px;
	}
	.bgn-wf-wrapper * {
	  box-sizing: border-box;
	}
	.bgn-wf-wrapper {
	  width: 100%;
	  margin:auto;
	  border: none;
	  padding: 15px;
	  background-color:#fff;
	  color:#333;
	}
	.bgn-wf-row {
	  padding: 5px 0 15px 0;
	  display: flex;
	}
	.bgn-wf-label {
	  padding: 7px 20px 5px 0px;
	  border: 0;
	  align-self: center;
	  word-break: break-word;
	  position: relative;
	}
	.bgn-wf-field {
	  vertical-align: top;
	  text-align: left;
	  word-break: break-word;
	  border: 0;
	  flex: 1;
	}
	.bgn-star {
	  color: #bb0707;width: 10px;height: 10px;z-index: 1;font-size: 14px;text-transform: inherit;position: absolute;
	}
	@media screen and (max-width: 590px) {
	.bgn-wf-row,
	.bgn-wf-label,
	.bgn-wf-field {
	  display: block;
	  width: 100%;
	}
	.bgn-wf-field input[type=text],
	.bgn-wf-field select,
	.bgn-wf-field textarea {width: 100% !important; }
	.bgn-wf-field div > select{
	  width: auto !important;
	}
	.bgn-wf-label:empty{display: none; }
	}
	.reset-btn, .submit-btn {
		padding: 10px 15px;
		border-radius: 4px;
		background-color: #000;
		color: #fff;
		border: none;
		font-size: 16px;
		transition: all 0.5s ease;
		cursor: pointer;
	}
	.submit-btn {
		background-color: var(--primary);
	}
	.reset-btn:hover, .submit-btn:hover {
		color: #000;
		background-color: var(--secondary);
	}
	.form-control, .form-control:focus-visible {
		padding: 12px 15px;
		width: 100%;
		background-color: #fff !important;
		border: 1px solid #ddd !important;
		border-radius: 30px !important;
		outline: none !important;
	}
	textarea.form-control {
		min-height: 120px;
	}
</style>
<div class="bgn-wf-wrapper" id="BiginWebToEntityFormDiv4656515000003053217">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <form id="BiginWebToContactForm4656515000003053217" name="BiginWebToContactForm4656515000003053217" method="POST" enctype="multipart/form-data" onsubmit="javascript:document.charset=&quot;UTF-8&quot;; return validateForm4656515000003053217()" accept-charset="UTF-8" style="margin: 0;" action="https://bigin.zoho.com/crm/WebToContactForm">
        <input type="text" style="display:none;" name="xnQsjsdp" value="6c9bfa7e8365d92f04b28f483f3c29bb32af25cffc16d86fc4c8172a8ed6d534">
        <input type="hidden" name="zc_gad" id="zc_gad" value="">
        <input type="text" style="display:none;" name="xmIwtLD" value="2a6d43142652ff05c15a66c6f21272dbcaf6044c5da637857abdba6589f8ada9">
        <input type="text" style="display:none;" name="actionType" value="Q29udGFjdHM=">
        <input type="text" style="display:none;" name="returnURL" value="https://webeesocial.com/thank-you/">
        <div id="elementDiv4656515000003053217">
            <div class="row-grid">
                <div class="col-md-6 mb-4">
                    <div class="bgn-wf-label">First Name <span class="bgn-star">*</span></div>
                    <div class="bgn-wf-field">
                        <input name="First Name" id="first_name" type="text" maxlength="40" value="" placeholder="">
                        <div class="error" id="first_name_error"></div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="bgn-wf-label">Last Name
                        <span class="bgn-star">*</span>
                    </div>
                    <div class="bgn-wf-field">
                        <input name="Last Name" type="text" id="last_name" maxlength="80" value="" placeholder="">
                        <div class="error" id="last_name_error"></div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="bgn-wf-label">Email
                        <span class="bgn-star">*</span>
                    </div>
                    <div class="bgn-wf-field">
                        <input name="Email" type="text" maxlength="100" value="" placeholder="" id="email">
                        <div class="error" id="email_error"></div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="bgn-wf-label">Phone Number
                        <span class="bgn-star">*</span>
                    </div>
                    <div class="bgn-wf-field">
                        <input name="Phone" type="text" pattern="[7-9]{1}[0-9]{9}" value="" placeholder="" id="contact">
                        <div class="error" id="contact_error"></div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="bgn-wf-label">Company Name
                        <span class="bgn-star">*</span>
                    </div>
                    <div class="bgn-wf-field">
                        <input name="Account Name" type="text" id="company_name" maxlength="120" value="" placeholder="">
                        <div class="error" id="company_name_error"></div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="bgn-wf-label">Requirements <span class="bgn-star">*</span></div>
                    <div class="bgn-wf-field">
                        <textarea name="Description" maxlength="32000" placeholder="" id="service"></textarea>
                        <div class="error" id="service_error"></div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="bgn-wf-label">Budget
                        <span class="bgn-star">*</span>
                    </div>
                    <div class="bgn-wf-field">
                        <select name="CONTACTCF1" id="budget">
                            <option value="">-Select-</option>
                            <option value="One-Time Project (Not Monthly)">One-Time Project (Not Monthly)</option>
                            <option value="INR 50000 to INR 1 Lakh Per Month">INR 50000 to INR 1 Lakh Per Month</option>
                            <option value="INR 1 Lac to INR 2 Lacs Per Month">INR 1 Lac to INR 2 Lacs Per Month</option>
                            <option value="INR 2 Lacs to INR 5 Lacs Per Month">INR 2 Lacs to INR 5 Lacs Per Month</option>
                            <option value="Above INR 5 lacs per month">Above INR 5 lacs per month</option>
                        </select>
                        <div class="error" id="budget_error"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="bgn-wf-label">Captcha</div>
                    <div class="bgn-wf-field">
                        <input type="text" name="enterdigest" id="enterdigest">
                    </div>
                </div>
                <div class="col-12">
                    <div class="bgn-wf-label"></div>
                    <div class="bgn-wf-field">
                        <img id="imgid4656515000003053217" src="https://bigin.zoho.com/crm/CaptchaServlet?formId=2a6d43142652ff05c15a66c6f21272dbcaf6044c5da637857abdba6589f8ada9&amp;grpid=6c9bfa7e8365d92f04b28f483f3c29bb32af25cffc16d86fc4c8172a8ed6d534">
                        <a href="javascript:;" onclick="reloadImg4656515000003053217()">Reload</a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="bgn-wf-label"></div>
                    <div class="bgn-wf-field">
                        <input id="formsubmit4656515000003053217" type="submit" class="btn btn-primary" value="Submit">
                    </div>                     
                </div>  
            </div>
        </div>
        <script>
            function reloadImg4656515000003053217() {
                var captcha = document.getElementById('imgid4656515000003053217');
                if (captcha.src.indexOf('&d') !== -1) {
                    captcha.src = captcha.src.substring(0, captcha.src.indexOf('&d')) + '&d' + new Date().getTime();
                } else {
                    captcha.src = captcha.src + '&d' + new Date().getTime();
                }
            }

            function disableSubmitwhileReset4656515000003053217() {
                var submitbutton = document.getElementById('formsubmit4656515000003053217');
                if (document.getElementById('privacyTool4656515000003053217') !== null || document.getElementById('consentTool') !== null) {
                    submitbutton.disabled = true;
                    submitbutton.style.opacity = '0.5;';
                } else {
                    submitbutton.removeAttribute('disabled');
                }
            }
            function checkMandatory4656515000003053217() {
                var mndFields=new Array('First Name','Last Name','Account Name','Email','Phone','Description','CONTACTCF1');
                var fldLangVal=new Array('First Name','Last Name','Company Name','Email','Phone','Requirements','Budget');
                var i;
                var mndFieldslength=mndFields.length;
                var fieldObj;

                custom_validation();
                
                // for (i = 0; i < mndFieldslength; i++) {
                //     fieldObj = document.forms.BiginWebToContactForm4656515000003053217[mndFields[i]];
                //     if (fieldObj) {
                //         if (fieldObj.value.replace(/^s+|s+$/g, '').length === 0) {
                //                 if (fieldObj.type === 'file') {
                //                     alert('Please select a file to upload.');
                //                     fieldObj.focus();
                //                     return false;
                //                 }
                //                 alert(fldLangVal[i] + ' cannot be empty.');
                //                 fieldObj.focus();
                //                 return false;
                //         } else if (fieldObj.nodeName === 'SELECT') {
                //                 if (fieldObj.options[fieldObj.selectedIndex].value === '-None-') {
                //                     alert(fldLangVal[i] + ' cannot be none.');
                //                     fieldObj.focus();
                //                     return false;
                //                 }
                //         } else if (fieldObj.type === 'checkbox') {
                //                 if (fieldObj.checked === false) {
                //                     alert('Please accept  ' + fldLangVal[i]);
                //                     fieldObj.focus();
                //                     return false;
                //                 }
                //         }
                //         if (fieldObj.name === 'Last Name' && fieldObj.value) {
                //                 name = fieldObj.value;
                //         }
                //     }
                // }
                // return true;
            }
            
            function validateFileUpload(){var e=document.getElementById("theFile"),t=0;if(e){if(e.files.length>3)return alert("You can upload a maximum of three files at a time."),!1;if("files"in e){var i=e.files.length;if(0!==i){for(var o=0;o<i;o++){var a=e.files[o];"size"in a&&(t+=a.size)}if(t>20971520)return alert("Total file(s) size should not exceed 20MB."),!1}}}return!0}
            
                function custom_validation(){
                resetErrors();
                let first_name = document.getElementById("first_name");
                let first_name_error = document.getElementById("first_name_error");

                let last_name = document.getElementById("last_name");
                let last_name_error = document.getElementById("last_name_error");

                let company_name = document.getElementById("company_name");
                let company_name_error = document.getElementById("company_name_error");

                let email  = document.getElementById("email");
                let email_error = document.getElementById("email_error");

                let contact = document.getElementById("contact");
                let contact_error = document.getElementById("contact_error");

                let service = document.getElementById("service");
                let service_error = document.getElementById("service_error");

                let budget = document.getElementById("budget");
                let budget_error = document.getElementById("budget_error");

                let enterdigest = document.getElementById("enterdigest");
                let can_submit = false;

                if(first_name.value == '' || first_name.value == null && !first_name.value.match(/^[a-zA-Z\-]+$/)){
                   first_name_error.innerHTML = 'First Name field is required!';
                }

                if(last_name.value == '' || last_name.value == null && !last_name.value.match(/^[a-zA-Z\-]+$/)){
                   last_name_error.innerHTML = 'Last Name field is required!';
                }

                if(company_name.value == '' || company_name.value == null ){
                    company_name_error.innerHTML = 'Company Name field is required!';
                }

                if(email.value == '' || email.value == null && email.value.match(/^[a-zA-Z\-]+$/)){
                    email_error.innerHTML = 'Email field is required!';
                }

                if(contact.value == '' || contact.value == null && contact.value.match(/^[a-zA-Z\-]+$/)){
                    contact_error.innerHTML = 'Contact field is required!';
                }

                if(service.value == '' || service.value == null){
                    service_error.innerHTML = 'Service field is required!';
                }

                if(budget.value == '' || budget.value == null){
                    budget_error.innerHTML = 'Budget is required!';
                }

                if(!isNull(first_name.value) && !isNull(last_name.value) && !isNull(email.value) && !isNull(contact.value) 
                    && !isNull(service.value) && !isNull(company_name.value) && !isNull(budget.value) && 
                    check_budget(budget.value) && contact.value.length==10 && check_first_name(first_name.value)
                    && check_last_name(last_name.value) && check_company_name(company_name.value)){
                    // let frm = document.getElementById("BiginWebToContactForm4656515000003053217");
                    // const formData = new FormData(frm);
                    // document.getElementById("formsubmit4656515000003053217").value='Submitting...';
                    // fetch('https://www.webeesocial.com/api/index.php', {
                    // method: 'POST',
                    // body:formData,
                    // })
                    // .then((response) => response.json())
                    // .then((data) => {
                    //     document.getElementById("formsubmit4656515000003053217").value='Submit';
                    //     if(data.success){
                    //         location.href='https://www.webeesocial.com/thank-you/'
                    //     }else{
                    //         alert('Someting Went Wrong');
                    //     }
                    // })
                    // .catch((error) => {
                    //     console.error('Error:', error);
                    // });
                    document.forms['BiginWebToContactForm4656515000003053217'].submit();
                }
            }

            function resetErrors(){
                document.getElementById("first_name_error").innerHTML='';
                document.getElementById("last_name_error").innerHTML='';
                document.getElementById("email_error").innerHTML='';
                document.getElementById("contact_error").innerHTML='';
                document.getElementById("company_name_error").innerHTML='';
                document.getElementById("service_error").innerHTML='';
                document.getElementById("budget_error").innerHTML='';
            }

            function isNull(data){
                if(data==null || data==''){
                    return true;
                }
                return false;
            }

            function check_budget(budget){
                if(budget=='One-Time Project (Not Monthly)' || budget =='INR 50000 to INR 1 Lakh Per Month' || budget =='INR 1 Lac to INR 2 Lacs Per Month' || budget =='INR 2 Lacs to INR 5 Lacs Per Month' || budget =='Above INR 5 lacs per month'){
                    return true;
                }
                document.getElementById("budget_error").innerHTML='Please select only given budget';
                return false;
            }

            function check_first_name(name){
                if(name=='Crytouncep' || name =='crytouncep'){
                    document.getElementById("first_name_error").innerHTML='Please enter valid name';
                    return false;
                }
                return true;
            }

            function check_last_name(name){
                if(name=='Crytouncep' || name =='crytouncep'){
                    document.getElementById("last_name_error").innerHTML='Please enter valid name';
                    return false;
                }
                return true;
            }

            function check_company_name(name){
                if(name=='Crytouncep' || name =='crytouncep'){
                    document.getElementById("company_name_error").innerHTML='Please enter valid name';
                    return false;
                }
                return true;
            }
            
            </script>
            
            <script id="wf_script" src="https://bigin.zoho.com/crm/WebformScriptServlet?rid=2a6d43142652ff05c15a66c6f21272dbcaf6044c5da637857abdba6589f8ada9gid6c9bfa7e8365d92f04b28f483f3c29bb32af25cffc16d86fc4c8172a8ed6d534"></script><script>var formname = document.BiginWebToContactForm; if(!formname){ formname = document.BiginWebToContactForm4656515000003053217 } formname.action = 'https://bigin.zoho.com/crm/WebToContactForm';function validateForm() {  return validateForm4656515000003053217();  }function validateForm4656515000003053217() {  if((typeof checkMandatory !== 'undefined' && checkMandatory()) || (typeof checkMandatory4656515000003053217 !== 'undefined' && checkMandatory4656515000003053217())) {var formname = document.BiginWebToContactForm; if(!formname){ formname = document.BiginWebToContactForm4656515000003053217 }  formname.submit();  }else{  event.preventDefault();  return false;  }  }</script>
    </form>
</div>