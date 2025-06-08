function vaccinatorprofile(dataid,mode,formhtml,formjs)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  mode = typeof mode !== 'undefined' ? mode : 1;

  var posturl = site_url+"vaccinator/profile/getform";
  var postparam = new FormData();

  var processresponse = function(postparam,returnparam){
      var pp = postparam;
      var rp = returnparam;
      if(rp.Status == 1)
      {
        profileform(dataid,rp.FormHTML,rp.FormJS);
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

function profileform(dataid,formhtml,formjs)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  var reqfld = '';
  var btnActionBox = '';
  btnActionBox += '<div class="font-size-12 p-15">';
  btnActionBox += '<div class="float-left">';
  btnActionBox += '<h6 class="mt-0"><i class="text-danger fa fa-fw fa-asterisk mr-10"></i>Required Fields</h6>';
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
    size: 'm',
    // title: ((dataid !== '') ? 'EDIT' : 'NEW ')+'RESIDENT PROFILE',
    message: '<div class="border border-secondary w-p40>"'+atob(formhtml)+'</div>'+btnActionBox,
    closeButton:false,
    onShow: function(e) {
      
     
    },
    onShown:function(e){
      eval(atob(formjs));
      Site.getInstance().initializePlugins();

      $("button[name*='btnActions']").click(function(){
        switch($(this).attr('id'))
        {
          case 'btnSave':
            $("[forminputgroup='vaccinatorformdata']").each(function(){
              if( reqfld.indexOf($(this).attr('id')) != -1 )
              {
                $(this).attr('required','required');
              }
            });
            var gFormData = getFormData('vaccinatorformdata');
            if( Object.keys(gFormData['ErrorData']).length > 0)
            {
              var rRequired = function(){ 
                $("[forminputgroup='vaccinatorformdata']").each(function(){
                  $(this).removeAttr('required');
                });
              };
              popFormDataError(gFormData['ErrorData'],'VACCINATOR PROFILE',rRequired);
            }
            else
            {
              var apiPath = site_url+'vaccinator/profile/submitform';
              var apiResult = function(pp,rp){
                
                if(rp.Status == 1)
                {
                  oTable_Obj['vaccinatordata_List'].draw();   
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
                  title: "VACCINATOR PROFILE",
                  html: rp.Message,
                  icon: (rp.Status == 1) ? 'success' : 'error',
                  confirmButtonText: (rp.Status == 1) ? '<i class="fa fa-vcard fa-fw mr-10"></i>NEW PROFILE' : '<i class="fa fa-times fa-fw mr-10"></i>CLOSE',
                   showCancelButton: (rp.Status == 1) ? true : false,
                  cancelButtonText:'<i class="fa fa-times fa-fw mr-10"></i>CLOSE',
                  reverseButtons:false,
                  allowOutsideClick:false,
                  allowEscapeKey:false
                }).then((result) => {

                  if (result.value) 
                  {
                    
                    if(rp.Status == 1)
                    {
                      $("[forminputgroup='vaccinatorformdata']").val(''); 
                    }
                    
                  }
                  else
                  {
                    $("button[id='btnClose'][name='btnActions']").click();
                  }
              
                });
              };

              submitFormData(apiPath,gFormData['FormData'],apiResult,true,true,0);
            }
          break;
        }
      });
    },
    onHidden:function(e){
    },  
  });
}