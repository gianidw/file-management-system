function vaccinationrecord(tableid,dataid)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  mode = typeof mode !== 'undefined' ? mode : 1;
  tableid = typeof tableid !== 'undefined' ? tableid : 'vaccinationdata_List';

  if(dataid !== '')
  {
    var posturl = site_url+"vaccination/index/getform";
    var postparam = new FormData();
    postparam.append('DataID',dataid);
    var processresponse = function(postparam,returnparam){
      var pp = postparam;
      var rp = returnparam;
      if(rp.Status == 1)
      {
        vaccineform(dataid,rp.FormHTML,rp.FormJS,tableid);
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
  else
  {
    var vaccinetlistHTML = '';
    var posturl = site_url+"utilities/getReferenceValue";
    var postparam = new FormData();
    postparam.append('ReferenceID',222);
    postparam.append('Filter',"Code in (3,7,12)");
    postparam.append('Order','');
    var getVaccineType = function(pp,rp){
      if(rp.Status == 1)
      {
        if( typeof(rp.Message) == 'object' )
        {
          var ReferenceList = rp.Message;
          var vaccinetlistHTML = '';
          for(var i in ReferenceList)
          {
            vaccinetlistHTML += '<div class="checkbox checkbox-custom custom-control checkbox-primary">';
            vaccinetlistHTML += '    <input type="checkbox" id="vaccinetlist['+ReferenceList[i]['ref_value']+']" name="vaccinetypelist[]" class="form-control" forminputgroup="vaccinetypelistdata" forminputgroupcheck="vaccinetypelistdata" value="'+ReferenceList[i]['ref_value']+'"  title="'+ReferenceList[i]['ref_description']+'"  >';
            vaccinetlistHTML += '    <label class="font-size-13 text-uppercase" for="vaccinetlist['+ReferenceList[i]['ref_value']+']">'+ReferenceList[i]['ref_description']+'</label>';
            vaccinetlistHTML += '</div>';
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
            title: "SELECT VACCINE TYPE",
            html: '<div class="text-left">'+vaccinetlistHTML+'</div>',
            width: 'auto',
            // icon: (rp.Status == 1) ? 'success' : 'error',
            confirmButtonText: 'PROCEED',
            showCancelButton: true,
            cancelButtonText:'CLOSE',
            reverseButtons:false,
            allowOutsideClick:false,
            allowEscapeKey:false
          }).then((result) => {

            if (result.value) 
            {
              var vaccinelistArray = $("input[name='vaccinetypelist[]']").serializeArray();

              if( vaccinelistArray.length > 0 )
              {
                var posturl = site_url+"vaccination/index/getform";
                var postparam = new FormData();
                jQuery.each( vaccinelistArray, function( i, field ) {
                     postparam.append(field.name, field.value);
                });
                var processresponse = function(postparam,returnparam){
                    var pp = postparam;
                    var rp = returnparam;
                    if(rp.Status == 1)
                    {
                      vaccineform(dataid,rp.FormHTML,rp.FormJS,tableid);
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
                  text: 'PLEASE SELECT VACCINE TYPE',
                  icon: 'error',
                  confirmButtonText: 'Close',
                }).then((result) => { 
                  getVaccineType(pp,rp);
                });
              }
            }
          });
        }
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
          text: 'Failed to Retrieve Vaccine Type List, please try again!',
          icon: 'error',
          confirmButtonText: 'Close',
        });
      }
    };

    submitFormData(posturl,postparam,getVaccineType,true);
  } 
}

function vaccineform(dataid,formhtml,formjs,tableid)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  var reqfld = '';
  var btnActionBox = '';
  btnActionBox += '<div class="font-size-12 p-15">';
  btnActionBox += '<div class="float-left">';
  btnActionBox += '<h6 class="mt-0 text-uppercase"><i class="text-danger fa fa-fw fa-asterisk mr-10"></i>Required Fields | <span class="text-info">(USE NODATA FOR (NON-INDIGENOUS) PROFILE WITH NO MIDDLE NAME )</span></h6>';
  btnActionBox += '</div>';
  btnActionBox += '<div class="float-right">';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2" id="btnSave" name="btnActions" title="SAVE PROFILE" style="">';
  btnActionBox += '    <i class="fa fa-save fa-fw mr-5"></i>SUBMIT';
  btnActionBox += '  </button>';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2 bootbox-close-button" id="btnClose" name="btnActions" title="CLOSE PROFILE FORM" style="">';
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
      $(".modal-xl").css('max-width','80vw');
     
    },
    onShown:function(e){
      eval(atob(formjs));
      Site.getInstance().initializePlugins();
      $("div[id='FormMainPanel']").show();
      $("button[name*='btnActions']").click(function(){
        switch($(this).attr('id'))
        {
          case 'btnSave':
            $("[forminputgroup='vaccinationformdata']").each(function(){
              if( reqfld.indexOf($(this).attr('id')) != -1 )
              {
                $(this).attr('required','required');
              }
            });
            var gFormData = getFormData('vaccinationformdata');
            if( Object.keys(gFormData['ErrorData']).length > 0)
            {
              var rRequired = function(){ 
                $("[forminputgroup='vaccinationformdata']").each(function(){
                  $(this).removeAttr('required');
                });
              };
              popFormDataError(gFormData['ErrorData'],'VACCINATION FORM',rRequired);
            }
            else
            {
              var apiPath = site_url+'vaccination/index/submitform';
              var apiResult = function(pp,rp){
                
                var UpdateMode = (rp.hasOwnProperty('UpdateForm') && rp.UpdateForm == true) ? true : false;

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
                  title: "VACCINATION FORM",
                  text: rp.Message,
                  icon: (rp.Status == 1) ? 'success' : 'error',
                  confirmButtonText: (!UpdateMode) ? ((rp.Status == 1) ? '<i class="fa fa-vcard fa-fw mr-10"></i>NEW RECORD' : '<i class="fa fa-times fa-fw mr-10"></i>CLOSE') : '<i class="fa fa-times fa-fw mr-10"></i>CLOSE',
                  showCancelButton: (!UpdateMode) ? ((rp.Status == 1) ? true : false) : false,
                  cancelButtonText:'<i class="fa fa-times fa-fw mr-10"></i>CLOSE',
                  reverseButtons:false,
                  allowOutsideClick:false,
                  allowEscapeKey:false
                }).then((result) => {
                  
                  if(!UpdateMode)
                  {
                    if (result.value) 
                    {
                      if(rp.Status == 1)
                      {
                        $("[forminputgroup='vaccinationformdata']").val('');
                      }
                    }
                    else
                    {
                      $("button[id='btnClose'][name='btnActions']").click();
                    }
                  }
                  else
                  {
                    $("button[id='btnClose'][name='btnActions']").click();
                  }
                });
              };

              if( $("input[type='hidden'][id='CitizenDataID']").length > 0 )
              {
                if( $("[forminputgroup='vaccinationformdata'][editted='true']").length > 0 )
                {
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
                    title: "VACCINATION FORM",
                    text: 'PROCEED DATA CHANGE SUBMISSION!',
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
                else
                {
                  $("button[id='btnClose'][name='btnActions']").click();
                }
              }
              else
              {
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
                  title: "VACCINATION FORM",
                  text: 'PROCEED VACCINATION FORM SUBMISSION!',
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
            }
          break;
        }
      });
    },
    onHidden:function(e){
    },  
  });
}