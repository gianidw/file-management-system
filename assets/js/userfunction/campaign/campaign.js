function newcampaign(tableid,dataid)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  mode = typeof mode !== 'undefined' ? mode : 1;
  tableid = typeof tableid !== 'undefined' ? tableid : 'campaign_List';

  var posturl = site_url+"campaign/index/getform";
  var postparam = new FormData();
  postparam.append('DataID',dataid);
  var processresponse = function(postparam,returnparam){
    var pp = postparam;
    var rp = returnparam;
    if(rp.Status == 1)
    {
      campaignform(dataid,rp.FormHTML,rp.FormJS,tableid);
    }
    else
    {
      Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-dark',
        },
        buttonsStyling: false,
        onBeforeOpen: (fnRun) => {
          $(".swal2-container").css('z-index',$.topZIndex());
        }
      }).fire({
        // title: "CREC REQUEST",
        text: rp.Message,
        icon: 'error',
        confirmButtonText: 'Close',
      });
    }
  };

  submitFormData(posturl,postparam,processresponse,true);
}

function campaignform(dataid,formhtml,formjs,tableid)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  var reqfld = '';
  var btnActionBox = '';
  btnActionBox += '<div class="font-size-12 p-15">';
  btnActionBox += '<div class="float-left">';
  btnActionBox += '<h6 class="mt-0 text-uppercase"><i class="text-danger fa fa-fw fa-asterisk mr-10"></i>Required Fields</span></h6>';
  btnActionBox += '</div>';
  btnActionBox += '<div class="float-right">';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2" id="btnSave" name="btnActions" title="SAVE CAMPAIGN" style="">';
  btnActionBox += '    <i class="fa fa-save fa-fw mr-5"></i>SUBMIT';
  btnActionBox += '  </button>';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2 bootbox-close-button" id="btnClose" name="btnActions" title="CLOSE CAMPAIGN FORM" style="">';
  btnActionBox += '    <i class="fa fa-times fa-fw mr-5"></i>CLOSE';
  btnActionBox += '  </button>';
  btnActionBox += '</div>';
  btnActionBox += '</div>';
  bootbox.dialog({
    size: 'xl',
    // title: ((dataid !== '') ? 'EDIT' : 'NEW ')+'VACCINATION RECORD',
    message: '<div class="border border-secondary w-p40>"'+atob(formhtml)+'</div>'+btnActionBox,
    closeButton:false,
    onShow: function(e) {
      $(".modal-xl").css('max-width','90vw');
     
    },
    onShown:function(e){
      eval(atob(formjs));
      Site.getInstance().initializePlugins();
      $("div[id='FormMainPanel']").show();
      $("button[name*='btnActions']").click(function(){
        switch($(this).attr('id'))
        {
          case 'btnSave':
            
            $("[forminputgroup='campaignformdata']").each(function(){
              if( reqfld.indexOf($(this).attr('id')) != -1 )
              {
                $(this).attr('required','required');
              }
            });

            var gFormData = getFormData('campaignformdata');

            if( $("input[agergroupinput='Y'][agegroupmode='FROM']").length == 0)
            {
              gFormData['ErrorData']['Campaign_AgeGroupList'] = 'AGE GROUP LIST';
            }
            else
            {
              var IncompleteAgeGroup = 0;
              $("input[agergroupinput='Y']").each(function(){
                if( !$(this).val() )
                {
                  IncompleteAgeGroup++;
                }
              });

              if(IncompleteAgeGroup > 0 )
              {
                gFormData['ErrorData']['Campaign_AgeGroupList'] = 'AGE GROUP LIST';
              }
            }

            var VaccineTypeSelected = 0;
            $("input[name='Campaign_Vaccine_Type[]']").each(function(){
              if( $(this).prop('checked') )
              {
                VaccineTypeSelected++;
              }
            });

            if(VaccineTypeSelected == 0 )
            {
              gFormData['ErrorData']['Campaign_Vaccine_Type'] = 'VACCINE / IMMUNIZATION TYPE';
            }

            var TargetRegionSelected = 0;
            $("input[name='Campaign_TargetRegion[]']").each(function(){
              if( $(this).prop('checked') )
              {
                TargetRegionSelected++;
              }
            });

            if(TargetRegionSelected == 0 )
            {
              gFormData['ErrorData']['Campaign_TargetRegion'] = 'TARGET REGION';
            }

            vTotalPercentageAge = 0;
            $("input[agegroupmode='PERCENTAGE']").each(function(){
              if($(this).val())
              {
                vTotalPercentageAge = parseInt(vTotalPercentageAge) + parseInt($(this).val());
                $("th[id='TotalPercentage_AgeGroup']").text(vTotalPercentageAge);
              }
            });

            if(vTotalPercentageAge > 100 || vTotalPercentageAge == 0)
            {
              gFormData['ErrorData']['TotalPercentage_AgeGroup'] = 'INVALID AGE GROUP PERCENTAGE';
            }

            if( Object.keys(gFormData['ErrorData']).length > 0)
            {
              var rRequired = function(){ 
                $("[forminputgroup='campaignformdata']").each(function(){
                  $(this).removeAttr('required');
                });
              };
              // console.log(gFormData['ErrorData']);
              popFormDataError(gFormData['ErrorData'],'CAMPAIGN FORM');
            }
            else
            {
              
              var apiPath = site_url+'campaign/index/submitform';
              var apiResult = function(pp,rp){
                
                if(rp.Status == 1)
                {
                  oTable_Obj[tableid].draw();   
                }
                
                Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-dark w-p45 mr-2',
                    cancelButton: 'btn btn-dark w-p45 ',
                  },
                  buttonsStyling: false,
                  onBeforeOpen: (fnRun) => {
                    $(".swal2-container").css('z-index',$.topZIndex());
                  }
                }).fire({
                  title: "CAMPAIGN FORM",
                  text: rp.Message,
                  icon: (rp.Status == 1) ? 'success' : 'error',
                  confirmButtonText: '<i class="fa fa-times fa-fw mr-10"></i>CLOSE',
                  showCancelButton: false,
                  cancelButtonText:'',
                  reverseButtons:false,
                  allowOutsideClick:false,
                  allowEscapeKey:false
                }).then((result) => {
                  
                  if (result.value) 
                  {
                    $("button[id='btnClose'][name='btnActions']").click();
                  }

                });
              };

              Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-dark w-p45 mr-2',
                  cancelButton: 'btn btn-dark w-p45 ',
                },
                buttonsStyling: false,
                onBeforeOpen: (fnRun) => {
                  $(".swal2-container").css('z-index',$.topZIndex());
                }
              }).fire({
                title: "CAMPAIGN FORM",
                text: 'PROCEED CAMPAIGN FORM SUBMISSION!',
                icon: 'question',
                confirmButtonText: 'YES',
                showCancelButton:true,
                cancelButtonText:'NO',
                reverseButtons:false,
                allowOutsideClick:false,
                allowEscapeKey:false
              }).then((result) => {
                
                if (result.value) 
                {
                  submitFormData(apiPath,gFormData['FormData'],apiResult,true,true,0);
                }

              });
            }
          break;
        }
      });
    },
    onHidden:function(e){
    },  
  });
}