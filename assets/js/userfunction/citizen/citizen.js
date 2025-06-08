function vvaccinationdetails(e,showname)
{
  showname = typeof showname !== 'undefined' ? showname : '';
  var posturl = site_url+"citizen/profile/getvaccinationdetails";
  var postparam = new FormData();
  postparam.append('RecordDataID',($(e).attr('id')).replace('vdf_',''));
  if(showname)
  {
    postparam.append('ShowCitizenProfile',true);
  }
  var processresponse = function(postparam,returnparam){
      var pp = postparam;
      var rp = returnparam;
      if(rp.Status == 1)
      {
        vaccinationformdetails(rp.FormHTML);
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

function vaccinationformdetails(formhtml)
{
  bootbox.dialog({
    size: 'xl',
    // title: 'VACCINATION RECORD',
    message: '<div class="">'+atob(formhtml)+'</div>',
    closeButton:false,
    onShow: function(e) {
    },
    onShown:function(e){
    },
    onHidden:function(e){
    },  
  });
}