function residentprofile(dataid,mode,formhtml,formjs)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  mode = typeof mode !== 'undefined' ? mode : 1;

  var posturl = site_url+"resident/profile/getresidentform";
  var postparam = new FormData();

  var processresponse = function(postparam,returnparam){
      var pp = postparam;
      var rp = returnparam;
      if(rp.Status == 1)
      {
        residentprofileform(dataid,rp.FormHTML,rp.FormJS);
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

function residentprofileform(dataid,formhtml,formjs)
{
  dataid = typeof dataid !== 'undefined' ? dataid : '';
  var reqfld = '';
  var btnActionBox = '';
  btnActionBox += '<div class="font-size-12 p-15 mt-10">';
  btnActionBox += '<div class="float-left">';
  btnActionBox += '<h6 class="mt-0"><i class="fa fa-fw fa-info-circle text-info mr-10"></i>Required Fields mark with <i class="text-danger fa fa-fw fa-asterisk"></i></h6>';
  btnActionBox += '</div>';
  btnActionBox += '<div class="float-right">';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2" id="btnSave" name="btnActions" title="SAVE RESIDENT PROFILE" style="">';
  btnActionBox += '    <i class="fa fa-save fa-fw mr-5"></i>SUBMIT';
  btnActionBox += '  </button>';
  btnActionBox += '  <button type="button" class="btn btn-dark ml-2 bootbox-close-button" id="btnClose" name="btnActions" title="CLSOE RESIDENT PROFILE FORM" style="">';
  btnActionBox += '    <i class="fa fa-times fa-fw mr-5"></i>CLOSE';
  btnActionBox += '  </button>';
  btnActionBox += '</div>';
  btnActionBox += '</div>';
  bootbox.dialog({
    size: 'xl',
    title: ((dataid !== '') ? 'EDIT' : 'NEW ')+'RESIDENT PROFILE',
    message: '<div class="border border-secondary w-p80>"'+atob(formhtml)+'</div>'+btnActionBox,
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
            $("[forminputgroup='residentformdata']").each(function(){
              if( reqfld.indexOf($(this).attr('id')) != -1 )
              {
                $(this).attr('required','required');
              }
            });
            var gFormData = getFormData('residentformdata');
            if( Object.keys(gFormData['ErrorData']).length > 0)
            {
              var rRequired = function(){ 
                $("[forminputgroup='residentformdata']").each(function(){
                  $(this).removeAttr('required');
                });
              };
              popFormDataError(gFormData['ErrorData'],'RESIDENT PROFILE',rRequired);
            }
            else
            {
              var apiPath = site_url+'resident/profile/submitresidentform';
              var apiResult = function(pp,rp){
                
                if(rp.Status == 1)
                {
                  oTable_Obj['residentdata_List'].draw();   
                }
                
                Swal.mixin({
                  customClass: {
                    confirmButton: 'btn btn-dark',
                  },
                  buttonsStyling: false,
                  onBeforeOpen: (fnRun) => {
                    $(".swal2-container").css('z-index',$.topZIndex());
                  }
                }).fire({
                  title: "RESIDENT PROFILE",
                  text: rp.Message,
                  icon: (rp.Status == 1) ? 'success' : 'error',
                  confirmButtonText: 'Close',
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