function newaccount(mode,sFormData)
{
  sFormData = typeof sFormData !== 'undefined' ? sFormData : {};
  mode = typeof mode !== 'undefined' ? mode : 1;
  if(typeof sFormData == 'object')
  {
    if(sFormData instanceof FormData)
    {
      var tmpFormData = {};
      for(var pair of sFormData.entries()) {
        tmpFormData[pair[0]] = pair[1];
      }

      sFormData = tmpFormData;
    }
  }

  var referenceForm  = '';
  referenceForm += '<div class="text-left" style="border-radius:5px"><form id="newaccountFormData" class="mb-0 mt-20" novalidate="novalidate">';
  if( sFormData.hasOwnProperty('Code') )
  {
  referenceForm += '  <input type="hidden" class="form-control font-size-14 text-uppercase" id="userid" name="userid" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('userid')) ? sFormData['userid'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('userid')) ? sFormData['userid'] : '')+'" autocomplete="newaccountFormData_off" required="required">'; 
  }

  referenceForm += '<div class="border border-light float-left p-2" style="width:350px"><h5>Account Information</h5>';

  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>USER TYPE</b></label>';
  referenceForm += '  <select title="User Type" class="form-control font-size-14 text-uppercase" id="usertype" name="usertype" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('usertype')) ? sFormData['usertype'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('usertype')) ? sFormData['usertype'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required"></select>';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>EMAIL ADDRESS</b></label>';
  referenceForm += '  <input type="text" title="Email Address" class="form-control font-size-14" id="emailaddress" name="emailaddress" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('emailaddress')) ? sFormData['emailaddress'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('emailaddress')) ? sFormData['emailaddress'] : '')+'" placeholder="accountemail@email.com" autocomplete="newaccountFormData_off" required="required">';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>REQUIRE ACTIVATION</b></label>';
  referenceForm += '  <select title="Require Account Activation" class="form-control font-size-14 text-uppercase" id="activationrequired" name="activationrequired" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData"  placeholder="" autocomplete="newaccountFormData_off" required="required"><option value="N" selected>NO</option><option value="Y">YES</option></select>';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>USER NAME</b></label>';
  referenceForm += '<div class="input-group">';
  referenceForm += '  <div class="form-control-wrap">';
  referenceForm += '  <input type="text" title="User Name" class="form-control font-size-14" id="username" name="username" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('username')) ? sFormData['username'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('username')) ? sFormData['username'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required" minlength="'+window.unmin+'" maxlength="'+window.unmax+'">';
  referenceForm += '  </div>';
  referenceForm += '   <span class="input-group-btn">';
  referenceForm += '    <button id="btnGenerateUserName" name="btnGenerateUserName" class="btn btn-dark waves-effect waves-classic" type="button">Generate</button>';
  referenceForm += '  </span>';
  referenceForm += '</div>';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>PASSWORD</b></label>';
  referenceForm += '<div class="input-group">';
  referenceForm += '  <div class="form-control-wrap">';
  referenceForm += '  <input type="text" title="Password" class="form-control font-size-14" id="password" name="password" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('password')) ? sFormData['password'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('password')) ? sFormData['password'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" minlength="'+window.passmin+'" maxlength="'+window.passmax+'" >';
  referenceForm += '  </div>';
  referenceForm += '   <span class="input-group-btn">';
  referenceForm += '    <button id="btnGeneratePassword" name="btnGeneratePassword" class="btn btn-dark waves-effect waves-classic" type="button">Generate</button>';
  referenceForm += '  </span>';
  referenceForm += '</div>';
  referenceForm += '</div>';

  referenceForm += '</div>';

  referenceForm += '<div class="border border-light float-right p-2" style="width:350px"><h5>User Profile</h5>';

  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>LAST NAME</b></label>';
  referenceForm += '  <input type="text" title="Last Name" class="form-control text-uppercase font-size-14" id="Lastname" name="Lastname" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Lastname')) ? sFormData['Lastname'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Lastname')) ? sFormData['Lastname'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required">';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>FIRST NAME</b></label>';
  referenceForm += '  <input type="text" title="First Name" class="form-control text-uppercase font-size-14" id="Firstname" name="Firstname" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Firstname')) ? sFormData['Firstname'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Firstname')) ? sFormData['Firstname'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required">';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>MIDDLE NAME</b></label>';
  referenceForm += '  <input type="text" title="Middle Name" class="form-control text-uppercase font-size-14" id="Middlename" name="Middlename" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Middlename')) ? sFormData['Middlename'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Middlename')) ? sFormData['Middlename'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required">';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>SUFFIX</b></label>';
  referenceForm += '  <select title="Suffix" class="form-control font-size-14 text-uppercase" id="Suffixname" name="Suffixname" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Suffixname')) ? sFormData['Suffixname'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Suffixname')) ? sFormData['Suffixname'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required"></select>';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>DATE OF BIRTH</b></label>';
  referenceForm += '  <input type="text" title="Date of Birth" class="form-control font-size-14" id="DateofBirth" name="DateofBirth" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('DateofBirth')) ? sFormData['DateofBirth'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('DateofBirth')) ? sFormData['DateofBirth'] : '')+'" placeholder="mm/dd/yyyy" data-plugin="formatter,datepicker" data-pattern="[[99]]/[[99]]/[[9999]]" autocomplete="newaccountFormData_off" required="required">';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>SEX</b></label>';
  referenceForm += '  <select title="Sex" class="form-control font-size-14 text-uppercase" id="Sex" name="Sex" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Sex')) ? sFormData['Sex'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Sex')) ? sFormData['Sex'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required"></select>';
  referenceForm += '</div>';
  referenceForm += '<div class="form-group form-material mb-0" data-plugin="formMaterial">';
  referenceForm += '  <label class="label font-size-12"><b>MOBILE NO</b></label>';
  referenceForm += '  <input type="text" title="Mobile No" class="form-control font-size-14" id="Mobile_no" name="Mobile_no" forminputgroup="newaccountFormData" forminputgroupcheck="newaccountFormData" value="'+( (sFormData.hasOwnProperty('Mobile_no')) ? sFormData['Mobile_no'] : '')+'" dfvalue="'+( (sFormData.hasOwnProperty('Mobile_no')) ? sFormData['Mobile_no'] : '')+'" placeholder="" autocomplete="newaccountFormData_off" required="required" data-plugin="formatter" data-pattern="09[[99]][[9999999]]">';
  referenceForm += '</div>';
  referenceForm += '</div>';

  referenceForm += '</form></div>';

  var fTitle = ((mode == 1) ? 'New' : 'Edit')+' User Account';

  mode = (Object.keys(sFormData).length > 0) ? 2 : 1;
    var referenceFormBox = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-dark w-p45 mr-2',
        cancelButton: 'btn btn-dark w-p45 ',
      },
      buttonsStyling: false,
      onBeforeOpen: (fnRun) => {
        $(".swal2-container").css('z-index',$.topZIndex());
        Site.getInstance().initializePlugins(); 
        getreferencevalue({objselect:$("select[id='usertype'][name='usertype'][forminputgroup='newaccountFormData']"),referenceid:'2',filter:'ID < 4',order:''});
        getreferencevalue({objselect:$("select[id='Sex'][name='Sex'][forminputgroup='newaccountFormData']"),referenceid:'51',filter:'',order:''});
        getreferencevalue({objselect:$("select[id='Suffixname'][name='Suffixname'][forminputgroup='newaccountFormData']"),referenceid:'55',filter:'',order:''});
         
        $("input[id='emailaddress'").blur(function(){
          if( !validateEmail($(this).val()) )
          {
            $(this).val('');
          }
        });
        $("select[id='activationrequired']").change(function(){ 
          if( $(this).val() == 'Y' )
          {
            $("input[id='password']").val('');
            $("input[id='password']").closest(".form-material").hide();
            $("input[id='password']").removeAttr('required').attr('disabled','disabled');
          }
          else
          {
            $("input[id='password']").closest(".form-material").show();
            $("input[id='password']").attr('required','required').removeAttr('disabled');
          }
        });
        $("button[id='btnGenerateUserName']").click(function(){
            $(this).html('<i class="fa fa-fw fa-circle-notch fa-spin"></i>&nbsp;Generate').attr('disabled','disabled');
            gbackendURL = site_url+'administrator/useraccount/generateusername';
            var gData = new FormData();
            var guserReturn = function(pp,rp){
              $("input[id='username']").val(rp.Message);
              $("button[id='btnGenerateUserName']").removeAttr('disabled').html('Generate');
            };
            submitFormData(gbackendURL,gData,guserReturn,false,true,0);
        });

        $("input[id='password']").blur(function(){
          if( ($(this).val()).length < parseInt(window.passmin) )
          {
            $(this).val('');
          }
        });
        $("input[id='username']").blur(function(){
          if( ($(this).val()).length < parseInt(window.unmin) )
          {
            $(this).val('');
          }
        });
        $("button[id='btnGeneratePassword']").click(function(){
          var slicep = parseInt(window.passmin) * -1;
          $("input[id='password']").val(Math.random().toString(36).slice(slicep));
        });

      }
    }).fire({
      title: fTitle,
      //icon:'info',
      width:"800px",
      html: referenceForm,
      showCancelButton: true,
      confirmButtonText: '<i class="fa fa-fw fa-save mr-5"></i>'+((mode == 1) ? 'Submit' : 'Save'),
      cancelButtonText:'<i class="fa fa-fw fa-times mr-5"></i>Cancel',
      reverseButtons:false,
      allowOutsideClick:false,
      allowEscapeKey:false,
    }).then((result) => {
      if (result.value)
      {
        var sFormData = getFormData('newaccountFormData');
        if( Object.keys(sFormData['ErrorData']).length > 0 )
        {
          window.popFormDataError(sFormData['ErrorData'],fTitle,newaccount,mode,sFormData['FormData']);
        }
        else
        {
          backendURL = site_url+'administrator/useraccount/submitaccount';
          var submitFormReturn = function(pp,rp){
            if(rp.Status == 1)
            {
              toastr.success( rp.Message ,fTitle);
              oTable_Obj['useraccountList'].draw(); 
            }
            else
            {
              toastr.error(rp.Message,fTitle);
              
            }
            Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-primary',
              },
              buttonsStyling: false,
              onBeforeOpen: (fnRun) => {
                $(".swal2-container").css('z-index',$.topZIndex());
              }
            }).fire({
              title: "",
              text: rp.Message,
              icon: (rp.Status == 1) ? "success" : "error",
              confirmButtonText: 'Close',
            });

          };
          submitFormData(backendURL,sFormData['FormData'],submitFormReturn,true,true,0);
        }
      }
    });
    
}
