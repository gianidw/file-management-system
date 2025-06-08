function ImportXLSLinelist(LinelistMasterRecord)
{
  LinelistMasterRecord = typeof LinelistMasterRecord !== 'undefined' ? LinelistMasterRecord : "";
  var filebutton = '';
  filebutton += '<div id="uploadButtonsBar" class="font-size-12 float-right">';
  filebutton += '  <button type="button" class="btn  text-uppercase btn-dark ml-2" id="BrowseFile" name="fuButtons" title="Browse XLS Linelist Template" style="padding:2px 10px">';
  filebutton += '    <i class="fa fa-file-excel-o mr-5"></i>Browse File';
  filebutton += '  </button>';

  filebutton += '  <button type="button" class="btn  text-uppercase btn-dark ml-2" id="StartUpload" name="fuButtons" title="Start File Upload" style="display:none;padding:2px 10px" disabled="disabled">';
  filebutton += '    <i class="fa fa-upload mr-5"></i>Start Upload';
  filebutton += '  </button>';

  filebutton += '  <button type="button" class="btn  text-uppercase btn-dark ml-2" id="StopUpload" name="fuButtons" title="Close File Upload" style="display:none;padding:2px 10px" disabled="disabled">';
  filebutton += '    <i class="fa fa-ban mr-5"></i>Stop Upload';
  filebutton += '  </button>';

  filebutton += '  <button type="button" class="btn  text-uppercase btn-dark ml-2 bootbox-close-button" id="CloseUpload" name="fuButtons" title="Close File Upload" style="padding:2px 10px">';
  filebutton += '    <i class="fa fa-times mr-5"></i>Close';
  filebutton += '  </button>';
  filebutton += '</div>';

  var fileUploadHTML = '';
  fileUploadHTML += '<input id="browsefileupload" type="file" name="files" style="display:none" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">'; 
  fileUploadHTML += '<div class="mb-5">';
    fileUploadHTML += '<div class="">';
      fileUploadHTML += '<table class="table table-sm border-0 mb-0">';
        fileUploadHTML += '<tr>';
          fileUploadHTML += '<td class="w-p40"><span class="small text-uppercase  font-weight-bold">File Name : </span><span id="FileName" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold">File Size : </span><span id="FileSize" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold">File Type : </span><span id="FileType" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold">Sheet Count : </span><span id="SheetCount" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
        fileUploadHTML += '</tr>';
      fileUploadHTML += '</table>';
       fileUploadHTML += '<table class="table table-sm border-0 mb-0">';
        fileUploadHTML += '<tr>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold mr-5">Linelist Record Count  : </span><span id="LinelistRecord_Count" name="importDisplay" class="small text-primary font-weight-bold"  style="cursor :pointer">0</span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold mr-5">Invalid Record: </span><span id="LinelistRecord_Invalid" name="importDisplay" class="small text-primary font-weight-bold" style="cursor :pointer">0</span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold mr-5">To Upload: </span><span id="LinelistRecord_ToUpload" name="importDisplay" class="small text-primary font-weight-bold"  style="cursor :pointer">0</span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold mr-5">Success : </span><span id="LinelistRecord_Success" name="importDisplay" class="small text-primary font-weight-bold"  style="cursor :pointer">0</span></td>';
          fileUploadHTML += '<td class="w-p20"><span class="small text-uppercase  font-weight-bold mr-5">Failed : </span><span id="LinelistRecord_Failed" name="importDisplay" class="small text-primary font-weight-bold"  style="cursor :pointer">0</span></td>';
        fileUploadHTML += '</tr>';
        fileUploadHTML += '<tr>';
          fileUploadHTML += '<td class="w-p100" colspan="5"><span class="small  text-uppercase font-weight-bold mr-5">Status :</span><span id="Status" name="importDisplay" class="small text-uppercase text-primary font-weight-bold"></span><i id="xlsstatusLoader" class="fa fa-circle-o-notch icon-spin float-right" style="display:none"></i></td>';
        fileUploadHTML += '</tr>';
      fileUploadHTML += '</table>';
    fileUploadHTML += '</div>';
   fileUploadHTML += '</div>';

  var tblHeader = '';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" style="width:1% !important" title="View Details"></th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" style="width:2% !important" title="Excel Row">#</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Indigenous</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Last Name</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">First Name</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Middle Name</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Suffix Name</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Date of Birth</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Sex</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Current Address Street</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Current Address Region</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Current Address Province</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Current Address City</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Current Address Barangay</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Place of Vaccination Region</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Place of Vaccination Province</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Place of Vaccination City</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10" style="display:none">Place of Vaccination Barangay</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10">ADMINISTERED VACCINE / SUPPLEMENT</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Action Taken</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p5 text-center font-size-10">Date of Action</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" style="display:none">Reason for Refusal/Deferral</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" style="display:none">Deferral Date of Next Visit</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" style="display:none">Vaccinator Name</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold w-p10 text-center font-size-10">Status</th>';
  tblHeader += '        <th class="text-white text-uppercase align-middle font-weight-bold text-center font-size-10" id="ColumnRemarks" style="display:none">Remarks</th>';

  fileUploadHTML += '<div class="border border-dark">';
  fileUploadHTML += '  <div class="scrollbar-dark thin" style="overflow-y:scroll">';
  fileUploadHTML += '  <table class="table table-sm table-striped mb-0 ">';
  fileUploadHTML += '    <thead>';
  fileUploadHTML += '      <tr class="bg-dark">';
  fileUploadHTML += tblHeader;
  fileUploadHTML += '      </tr>';
  fileUploadHTML += '    </thead>';
  fileUploadHTML += '  </table>';
  fileUploadHTML += '  </div>';
  fileUploadHTML += '  <div class="scrollbar-dark thin" style="overflow-y:scroll">';
  fileUploadHTML += '   <table id="FileBrowseContent" class="table table-sm table-striped">';
  fileUploadHTML += '    <thead>';
  fileUploadHTML += '      <tr class="bg-dark" style="display:none">';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase font-weight-bold">File Name : </span><span id="FileName" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold">File Size : </span><span id="FileSize" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold">File Type : </span><span id="FileType" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold">Sheet Count : </span><span id="SheetCount" name="importDisplay" class="small text-primary font-weight-bold"></span></td>';
          fileUploadHTML += '<td colspan="14"></td>';
  fileUploadHTML += '      </tr>';
  fileUploadHTML += '      <tr class="bg-dark" style="display:none">';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold mr-5">Linelist Record Count  : </span><span id="LinelistRecord_Count2" name="importDisplay" class="small text-primary font-weight-bold">0</span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold mr-5">Invalid Record: </span><span id="LinelistRecord_Invalid" name="importDisplay" class="small text-primary font-weight-bold">0</span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold mr-5">To Upload: </span><span id="LinelistRecord_ToUpload2" name="importDisplay" class="small text-primary font-weight-bold">0</span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold mr-5">Success : </span><span id="LinelistRecord_Success2" name="importDisplay" class="small text-primary font-weight-bold">0</span></td>';
          fileUploadHTML += '<td class="w-p20" colspan="3"><span class="small text-uppercase  font-weight-bold mr-5">Failed : </span><span id="LinelistRecord_Failed2" name="importDisplay" class="small text-primary font-weight-bold">0</span></td>';
          fileUploadHTML += '<td colspan="11"></td>';
  fileUploadHTML += '      </tr>';
  fileUploadHTML += '      <tr class="bg-dark" style="display:none">';
  fileUploadHTML += tblHeader;
  fileUploadHTML += '      </tr>';
  fileUploadHTML += '    </thead>';
  fileUploadHTML += '      <tbody>';
  fileUploadHTML += '      </tbody>';
  fileUploadHTML += '    </table>';
  fileUploadHTML += '  </div>';
  fileUploadHTML += '<div>';

  bootbox.dialog({
    size: 'xl',
    title: 'IMPORT LINELIST'+filebutton,
    message: fileUploadHTML,
    closeButton:false,
    onShow: function(e) {
      $(".modal-xl").css('max-width','90vw');
      $("div[id='uploadButtonsBar']").closest(".modal-header").addClass('p-5');
      $("input[id='browsefileupload']").closest(".modal-body").addClass('p-5');

      $("table[id='FileBrowseContent']").parent().css('height',($(window).height() - 275)+'px');
      $("div[id='uploadButtonsBar']").closest('h5').css('width','100%');
      
      var LineListDataFinal = {};
      var UploadingStats = false;
      $("button[name='fuButtons']").click(function(){
        switch( $(this).attr('id') )
        {
          case 'BrowseFile':
            LineListDataFinal = {};
            $("span[name*='importDisplay']").text('');
            $("table[id='FileBrowseContent'] tbody").html('');
            $("button[id='StartUpload'][name='fuButtons'],button[id='StopUpload'][name='fuButtons']").attr('disabled','disabled').hide();
            $("input[id='browsefileupload']").val('');
            $("input[id='browsefileupload']").click();
          break;

          case 'StartUpload':
                  $("button[id='StopUpload'][name='fuButtons']").removeAttr('disabled').show();
                  $("button[id='StartUpload'][name='fuButtons'],button[id='BrowseFile'][name='fuButtons'],button[id='CloseUpload'][name='fuButtons']").attr('disabled','disabled').hide();
                  window.UploadingStats = true;
                  $("span[name='importDisplay'][id='Status']").text('Starting Linelist Data Import/Upload, Please wait. . .');

                  uploadmasterlinelist(window.LineListDataFinal)
                  //Upload(LinelistMasterRecord,window.LineListDataFinal,1,0);
          break;

          case 'StopUpload':
            $("button[id='StopUpload'][name='fuButtons']").attr('disabled','disabled').hide();
            window.UploadingStats = false;
            $("span[name='importDisplay'][id='Status']").text('Stopping Upload Process......');
          break;
        }
      });

      $("input[id='browsefileupload']").change(function(){  
          if (this.files && this.files[0])
          {
            
            var xlsFiles = $(this)[0].files;
            var xlsFileParam = xlsFiles[0];
            $("span[name='importDisplay'][id='FileName']").text(xlsFileParam['name']);
            $("span[name='importDisplay'][id='FileSize']").text(formatBytes(xlsFileParam['size']));
            var dFileType = ( xlsFileParam['type'] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") ? 'xlsx' : 'xls';
            $("span[name='importDisplay'][id='FileType']").text(dFileType);
            $("span[name='importDisplay'][id='Status']").text('Selected File : '+xlsFileParam['name']);

            window.xFileData = {
              'FileName'    : xlsFileParam['name'],
              'FileSize'    : xlsFileParam['size'],
              'FileType'    : dFileType,
              'SheetCount'  : '',
              'RecordCount' : '',
            };

            window.xFileDataRowDetails = {};

            if (!window.File || !window.FileReader || !window.FileList || !window.Blob)
            {
              alert('The File APIs are not fully supported in this browser.');
            }
            else
            {
              $("button[id='BrowseFile'][name='fuButtons']").hide();
              $("button[id='CloseUpload'][name='fuButtons']").hide();

              var xlsxflag = (dFileType == "xlsx") ? true : false;
              var reader = new FileReader();
              //For Browsers other than IE.
              $("span[name='importDisplay'][id='Status']").text('Verifying File Content : '+xlsFileParam['name']+' might take a while depending on the Record Size.');
              $("i[id='xlsstatusLoader']").show();
              if (reader.readAsBinaryString) 
              {
                reader.onload = function (e) { 
                    $("span[name='importDisplay'][id='Status']").text('Reading Linelist Sheet Record. . . .');
                    ProcessExcel(e.target.result);
                };
                reader.readAsBinaryString(xlsFileParam);
              }
              else 
              {
                //For IE Browser.
                reader.onload = function (e) {
                    var data = "";
                    var bytes = new Uint8Array(e.target.result);
                    for (var i = 0; i < bytes.byteLength; i++) {
                        data += String.fromCharCode(bytes[i]);
                    }

                    $("span[name='importDisplay'][id='Status']").text('Reading Linelist Sheet Record. . . .');
                    ProcessExcel(data);
                };
                reader.readAsArrayBuffer(xlsFileParam);
              }


            }
          }
          else
          {
            LineListDataFinal = {};
            $("span[name*='importDisplay']").text('');
            $("table[id='FileBrowseContent'] tbody").html('');
            $("button[id='StartUpload'][name='fuButtons']").attr('disabled','disabled').hide();
          }   
      });

    },
    onShown:function(e){

    },
    onHidden:function(e){
      $("i[id*='removeFileID_'],i[id*='addFileID_']").unbind('click');
    }
  });
}

function ProcessExcel(data) {
    //Read the Excel File data.

    var workbook = XLSX.read(data, {
        type: 'binary'
    });


    var SheetsName = workbook.SheetNames;

    $("span[name='importDisplay'][id='SheetCount']").text(SheetsName.length);
    window.xFileData['SheetCount'] = SheetsName.length;

    if( SheetsName.indexOf('VaccinationList') < 0 )
    {
      $("span[name='importDisplay'][id='Status']").text('Invalid Excel Template, Linelist Sheet not detected!');
    }
    else
    {

      var Linelist = workbook.SheetNames[ SheetsName.indexOf('VaccinationList') ];
      var LinelistexcelRows = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[Linelist]);

      var LineListSheetData = {};
      var LineListGroupInfo = {};
      var lRecordCount = 0;
      var LinelistCount = 0;
      var LinelistInvalidCount = 0;
      var grpCounter = 0;
      var grpIncrement = 1;
      var MainKeyHolder = Object.keys(LinelistexcelRows[1]);
      var MainKeyData = LinelistexcelRows[1];
      var rFieldKeys = {
      'Indigenous' : 'required',
      'Lastname' : 'required',
      'Firstname' : 'required',
      'Middlename' : '',
      'Suffixname' : '',
      'DateofBirth' : 'required',
      'Sex' : 'required',
      'Present_Address_St' : 'required',
      'Present_Address_Region' : 'required',
      'Present_Address_Province' : 'required',
      'Present_Address_City' : 'required',
      'Present_Address_Barangay' : 'required',
      'Vaccination_Location_Region' : 'required',
      'Vaccination_Location_Province' : 'required',
      'Vaccination_Location_City' : 'required',
      'Vaccination_Location_Barangay' : 'required',
      'Vaccine_Type' : 'required',
      'VaccinationAction' : 'required',
      'ActionDate' : 'required',
      'Reason' : '',
      'Deferral_DateofNextVisit' : '',
      'Vaccinator_Name' : 'required'
      }

      var xValidContent = true;
      var xInvalidContentCnt = 0;
      if( MainKeyHolder.length !== Object.keys(rFieldKeys).length )
      {
        xValidContent = false;
      }

      for(var ik in rFieldKeys)
      {
        if( !MainKeyHolder.includes(ik) )
        {
          xInvalidContentCnt++;
        }
      }

      if(xInvalidContentCnt > 0)
      {
        xValidContent = false;
      }

      if(xValidContent)
      {
        
        $("span[name='importDisplay'][id='LinelistRecord_Count2']").text($("span[name='importDisplay'][id='LinelistRecord_Count']").text());
        LineListSheetData[grpIncrement] = {};
        for (var i = 2; i < LinelistexcelRows.length; i++) 
        {
            var llDRow = LinelistexcelRows[i];
            var VaccineTypeDisplay = '';
            lRecordCount++;

            // Initial Validation
            var FailedValidation = false;
            var FailedValidationMessage = '';

            llDRow['Indigenous'] = (llDRow.hasOwnProperty('Indigenous') ) ? (( llDRow['Indigenous'] == "" ) ? "NO" : llDRow['Indigenous']) : "NO";
            llDRow['Suffixname'] = (llDRow.hasOwnProperty('Suffixname') ) ? (( llDRow['Suffixname'] == "" ) ? "N/A" : llDRow['Suffixname']) : "N/A";

            for(var fkc in rFieldKeys)
            {
              if(rFieldKeys[fkc] == 'required' )
              {
                if( (llDRow.hasOwnProperty(fkc) && llDRow[fkc] == "") || !llDRow.hasOwnProperty(fkc) )
                {
                  FailedValidationMessage = 'Incomplete Vaccination Data!';
                  FailedValidation = true;
                  break;
                }
              }   
            }

            if(!FailedValidation)
            {
              // Passed Required Data Validation --> Check for other Validation
              if( (llDRow['Indigenous']).toUpperCase() == "NO" && llDRow['Middlename'] == '' )
              {
                FailedValidationMessage = 'Invalid Demographic Data!, Please Enter Middle Name';
                FailedValidation=true;
              }

              if( llDRow['Lastname'].length == 1 || llDRow['Firstname'].length == 1 || llDRow['Middlename'].length == 1)
              {
                FailedValidationMessage = 'Invalid Demographic Data!, Invalid Vaccinee Name';
                FailedValidation=true;
              }

              if( llDRow['Lastname'] == llDRow['Firstname'] || llDRow['Middlename'] == llDRow['Firstname'])
              {
                FailedValidationMessage = 'Invalid Demographic Data!, Invalid Vaccinee Name';
                FailedValidation=true;
              }

              var tmpDOB = (( llDRow.hasOwnProperty('DateofBirth') ) ? ( ( moment(llDRow['DateofBirth'], "MM/DD/YYYY", true).isValid() ) ? llDRow['DateofBirth'] : ExcelDateToJSDate(llDRow['DateofBirth']))  : '');
              if( tmpDOB == "" || (tmpDOB).toUpperCase() == "INVALID DATE")
              {
                FailedValidationMessage = 'Invalid Demographic Data!, Invalid Date of Birth';
                FailedValidation=true;
              }

              var tmpActionDate = (( llDRow.hasOwnProperty('ActionDate') ) ? ( ( moment(llDRow['ActionDate'], "MM/DD/YYYY", true).isValid() ) ? llDRow['ActionDate'] : ExcelDateToJSDate(llDRow['ActionDate']))  : '');
              if( tmpActionDate == "" || (tmpActionDate).toUpperCase() == "INVALID DATE")
              {
                FailedValidationMessage = 'Invalid Vaccination Data!, Invalid Vaccination Action Date';
                FailedValidation=true;
              }

              if( ( (llDRow['VaccinationAction'].toUpperCase()).trim() !== 'VACCINATE') && llDRow['Reason'] == '' )
              {
                FailedValidationMessage = 'Invalid Vaccination Data!, Please Deferral/Refusal Reason';
                FailedValidation=true;
              }

              if( ( (llDRow['VaccinationAction'].toUpperCase()).trim() == 'DEFER')  )
              {
                if( llDRow['Deferral_DateofNextVisit'] == '' )
                {
                  FailedValidationMessage = 'Invalid Vaccination Data!, Invalid Defferal Date of Next Visit';
                  FailedValidation=true;
                }
                else
                {
                  var tmpDeferral_DateofNextVisit = (( llDRow.hasOwnProperty('Deferral_DateofNextVisit') ) ? ( ( moment(llDRow['Deferral_DateofNextVisit'], "MM/DD/YYYY", true).isValid() ) ? llDRow['Deferral_DateofNextVisit'] : ExcelDateToJSDate(llDRow['Deferral_DateofNextVisit']))  : '');
                  if( tmpDeferral_DateofNextVisit == "" || (tmpDeferral_DateofNextVisit).toUpperCase() == "INVALID DATE")
                  {
                    FailedValidationMessage = 'Invalid Vaccination Data!, Invalid Defferal Date of Next Visit';
                    FailedValidation=true;
                  }
                }
              
              }

             

            }
            
            var vLineDetails = {};
            var fLinelistRow = {};
            for(var ik in MainKeyData)
            {
              var tmpVAL = (ik in llDRow) ? llDRow[ik] : "";
              var tmpDVAL = tmpVAL;
              var xtmpVAL = '';
              var xtmpDVAL = '';
              if( tmpVAL.toString().indexOf("_") > -1 )
              {
                var splitIK = llDRow[ik].split("_");
                xtmpVAL = splitIK[(splitIK.length - 1)];
                splitIK.splice((splitIK.length - 1), 1);
                xtmpDVAL = splitIK.join(" ");
              }

              switch(ik)
              {
                case 'DateofBirth':
                case 'ActionDate':
                case 'Deferral_DateofNextVisit':
                  tmpVAL = (( llDRow.hasOwnProperty(ik) ) ? ( ( moment(llDRow[ik], "MM/DD/YYYY", true).isValid() ) ? llDRow[ik] : ExcelDateToJSDate(llDRow[ik]))  : '');
                  tmpVAL = ( tmpVAL == "" || (tmpVAL).toUpperCase() == "INVALID DATE" ) ? "" : tmpVAL;
                  tmpDVAL = tmpVAL;
                break;

                case 'Present_Address_Barangay':
                case 'Vaccination_Location_Barangay':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Present_Address_City':
                case 'Vaccination_Location_City':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Present_Address_Province':
                case 'Vaccination_Location_Province':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Present_Address_Region':
                case 'Vaccination_Location_Region':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Vaccine_Type':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Reason':
                    tmpVAL = xtmpVAL;
                    tmpDVAL = xtmpDVAL;
                break;
                case 'Sex':
                    tmpVAL = ( tmpVAL.toUpperCase() == 'FEMALE') ? 'F' : ((tmpVAL.toUpperCase() == 'MALE') ? 'M' : 'U');
                break;
                case 'Indigenous':
                    tmpVAL = ( tmpVAL.toUpperCase() == 'YES') ? 'Y' : 'N';
                break;
                case 'VaccinationAction':
                    switch( (tmpVAL.toUpperCase()).trim() )
                    {
                      case 'VACCINATE':
                          tmpVAL = 1;
                      break;
                      case 'DEFER':
                          tmpVAL = 3;
                      break;
                      case 'REFUSE':
                          tmpVAL = 2;
                      break;
                    }
                break;
                case 'Suffixname':
                  tmpVAL = ( tmpVAL.toUpperCase() == 'N/A') ? 'NA' : tmpVAL.replace(".","");
                  tmpVAL = tmpVAL.toUpperCase();
                break;
              }

              vLineDetails[ik] = { 'Caption' : (MainKeyData[ik]).replace("\r\n"," "), 'Value' : tmpDVAL }; 
              fLinelistRow[ik] = tmpVAL;
            }

            var randomIndex = (Math.random() + 1).toString(36).substring(7)+i;
            vLineDetails['validationRemarks'] = { 'Caption' : 'Pre-Validation Remarks', 'Value' : (FailedValidationMessage) ? '<span class="text-danger">'+FailedValidationMessage+'</span>' : ''}; 
            window.xFileDataRowDetails[btoa(randomIndex)] = vLineDetails;

            if(FailedValidation)
            {
              LinelistInvalidCount++;
            }
            else
            {  
              LinelistCount++;
              grpCounter++;
             
              if(grpCounter > 100)
              {
                grpIncrement++;
                grpCounter = 1;
                LineListSheetData[grpIncrement] = {};
              }

              LineListSheetData[grpIncrement][i] = fLinelistRow;
              LineListGroupInfo['Row_'+i]=grpIncrement; 

            }

            if( llDRow.hasOwnProperty('Vaccine_Type'))
            {
              var splitVType = llDRow['Vaccine_Type'].split("_");
              VaccineTypeDisplay = splitVType[0];
            }
           

            var tr  = '<tr class="'+( (FailedValidation) ? ' bg-danger invalidData ' : ' validData ')+'" id="llr_'+i+'" name="linelistRow" groupData="'+( (FailedValidation) ? '' : grpIncrement)+'" DataNo="'+i+'" >';
                    tr += '<td class="font-size-10 text-uppercase text-center" style="width:1% !important"><i class="fa fa-fw fa-search" title="View Details" style="cursor:pointer" onclick="vrowdetails(\''+randomIndex+'\')"></i></td>';
                    tr += '<td class="font-size-10 text-uppercase text-center" style="width:2% !important">'+lRecordCount+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Indigenous') ) ? llDRow['Indigenous'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Lastname') ) ? llDRow['Lastname'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Firstname') ) ? llDRow['Firstname'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Middlename') ) ? llDRow['Middlename'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Suffixname') ) ? llDRow['Suffixname'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('DateofBirth') ) ? ( ( moment(llDRow['DateofBirth'], "MM/DD/YYYY", true).isValid() ) ? llDRow['DateofBirth'] : ExcelDateToJSDate(llDRow['DateofBirth']))  : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('Sex') ) ? llDRow['Sex'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Present_Address_St') ) ?  llDRow['Present_Address_St'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Present_Address_Region') ) ?  llDRow['Present_Address_Region'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Present_Address_Province') ) ?  llDRow['Present_Address_Province'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Present_Address_City') ) ?  llDRow['Present_Address_City'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Present_Address_Barangay') ) ?  llDRow['Present_Address_Barangay'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Vaccination_Location_Region') ) ?  llDRow['Vaccination_Location_Region'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Vaccination_Location_Province') ) ?  llDRow['Vaccination_Location_Province'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Vaccination_Location_City') ) ?  llDRow['Vaccination_Location_City'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Vaccination_Location_Barangay') ) ?  llDRow['Vaccination_Location_Barangay'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p10">'+(( llDRow.hasOwnProperty('Vaccine_Type') ) ? VaccineTypeDisplay : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('VaccinationAction') ) ? llDRow['VaccinationAction'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p5">'+(( llDRow.hasOwnProperty('ActionDate') ) ? ( ( moment(llDRow['ActionDate'], "MM/DD/YYYY", true).isValid() ) ? llDRow['ActionDate'] : ExcelDateToJSDate(llDRow['ActionDate']))  : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Reason') ) ?  llDRow['Reason'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Deferral_DateofNextVisit') ) ? ( ( moment(llDRow['Deferral_DateofNextVisit'], "MM/DD/YYYY", true).isValid() ) ? llDRow['Deferral_DateofNextVisit'] : ExcelDateToJSDate(llDRow['Deferral_DateofNextVisit']))  : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" >'+(( llDRow.hasOwnProperty('Vaccinator_Name') ) ?  llDRow['Vaccinator_Name'] : '')+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center w-p10 text-'+( (FailedValidationMessage) ? 'white' : 'info')+'" id="RowDataStatus_'+i+'">'+FailedValidationMessage+'</td>';
                    tr += '<td class="font-size-10 text-uppercase text-center text-info" style="display:none" id="RowDataRemarks_'+i+'">'+( (FailedValidationMessage) ? 'SKIPPED' : '')+'</td>';
                  tr += '</tr>';
            $("table[id='FileBrowseContent'] tbody").append(tr);
        }

        $("span[name='importDisplay'][id='LinelistRecord_Count']").text(lRecordCount);
        $("span[name='importDisplay'][id='LinelistRecord_Invalid']").text(parseInt(LinelistInvalidCount));
        $("span[name='importDisplay'][id='LinelistRecord_ToUpload']").text(parseInt(LinelistCount));
        window.xFileData['RecordCount'] = parseInt(LinelistCount);
        $("span[name='importDisplay'][id='LinelistRecord_ToUpload2']").text($("span[name='importDisplay'][id='LinelistRecord_ToUpload']").text());
        $("span[name='importDisplay'][id='Status']").text('Reading Linelist Completed, Please click Upload Button to Start Import Process.');

        $("span[name='importDisplay'][id='LinelistRecord_Success'],span[name='importDisplay'][id='LinelistRecord_Failed']").text(parseInt(0));

        if(LinelistCount > 0)
        {
          $("button[id='StartUpload'][name='fuButtons']").removeAttr('disabled').show();
          window.LineListDataFinal=LineListSheetData;

        }
      }
      else
      {
        $("span[name='importDisplay'][id='Status']").text('Invalid Excel Template, Linelist Sheet not detected!');
      }
    }
    
    $("button[id='BrowseFile'][name='fuButtons']").show();
    $("button[id='CloseUpload'][name='fuButtons']").show();
    $("i[id='xlsstatusLoader']").hide();

    $("span[name='importDisplay']").unbind('click').click(function(){
      switch( $(this).attr('id') )
      {
          case 'LinelistRecord_Invalid':
            $("tr.validData").hide();
            $("tr.invalidData").show();
          break;

          case 'LinelistRecord_ToUpload':
            $("tr.validData").show();
            $("tr.invalidData").hide();
          break;

          case 'LinelistRecord_Count':
            $("tr[name='linelistRow']").show();
          break;

          case 'LinelistRecord_Success':
            $("tr[name='linelistRow']").hide();
            $("tr.successUpload").show();
          break;
 
          case 'LinelistRecord_Failed':
            $("tr[name='linelistRow']").hide();
            $("tr.failedUpload").show();
          break; 
      }
        
    });
}

function uploadmasterlinelist(linelistdata)
{
  var PostResult = function(pp,rp){
    if(rp.Status == 1)
    {
      Upload(rp.DataID,linelistdata,1,0);
    }
    else
    {
      $("span[name='importDisplay'][id='Status']").text(rp.Message);
      $("i[id='xlsstatusLoader']").hide();
      $("button[id='BrowseFile'][name='fuButtons'], button[id='CloseUpload'][name='fuButtons']").show();
      $("button[id='StopUpload'][name='fuButtons']").attr('disabled','disabled').hide();
      window.UploadingStats = false;
    }
  };

  postUrl = site_url+'linelist/index/uploadmasterlinelist';
  submitFormData(postUrl,window.xFileData,PostResult,false,true,0);
}

function Upload(LinelistMasterRecord,data,cnt,dcnt)
{
  
  if(window.UploadingStats)
  {
    if(cnt <= Object.keys(data).length )
    {
      var SetContent = data[cnt];
      var ldcnt = (dcnt == 0) ? 1 : (dcnt+1);
      for(var ikey in SetContent)
      {
        $("td[id='RowDataStatus_"+ikey+"']").html('<i class="fa fa-spinner icon-spin"></i><i class="ml-5">Processing. . .</i>');
        dcnt++;
      }

      $("span[name='importDisplay'][id='Status']").text('Processing Record '+ldcnt+' to '+(dcnt)+' out of '+parseInt($("span[id='LinelistRecord_ToUpload']").text())+' Linelist Record');
      $("i[id='xlsstatusLoader']").show();

      var PostimportResult = function(pp,rp){
        // console.log(pp);
        clearTimeout(skipLoop);
        if(rp.Status == 1)
        {
          var vData = rp.ImportResult;
          for(var vr in vData)
          {
            var istatus = '';
            if(vData[vr]['ImportStatus'] == 1)
            {
              istatus = '<i class="fa fa-check text-success mr-5"></i>Data Record ID : \''+vData[vr]['DataRecordID']+"'";
              $("span[id='LinelistRecord_Success']").text( parseInt($("span[id='LinelistRecord_Success']").text()) + 1 );
              $("span[id='LinelistRecord_Success2']").text( parseInt($("span[id='LinelistRecord_Success']").text()) );
              $("tr[id='llr_"+vr+"']").addClass('successUpload');
            }
            else
            {
              istatus = '<i class="fa fa-times text-danger mr-5"></i>Data Import Failed!';
              $("td[id='RowDataRemarks_"+vr+"']").html(vData[vr]['ImportRemarks']);
              $("span[id='LinelistRecord_Failed']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) + 1 );
              $("span[id='LinelistRecord_Failed2']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) );
              $("tr[id='llr_"+vr+"']").addClass('failedUpload');
            }

            $("td[id='RowDataStatus_"+vr+"']").html(istatus).attr("title",vData[vr]['ImportRemarks']);
            document.getElementById("llr_"+vr).scrollIntoView( {behavior: "smooth" });
          }
        }
        else
        {
          for(var pk in pp)
          {
            if(pk !== "UToken" )
            {
              $("td[id='RowDataRemarks_"+pk+"']").html("Unable to Process Request");
              $("span[id='LinelistRecord_Failed']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) + 1 );
              $("span[id='LinelistRecord_Failed2']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) );
              $("td[id='RowDataStatus_"+pk+"']").html('<i class="fa fa-times text-danger mr-5"></i>Data Import Failed!').attr("title",'Unable to Process Request');
              $("tr[id='llr_"+pk+"']").addClass('failedUpload');
              document.getElementById("llr_"+pk).scrollIntoView( {behavior: "smooth" });
            }
          }
        }

        cnt++; // Will be moved inside ajax event
        // Upload(LinelistMasterRecord,data,cnt,dcnt); // Will be moved inside ajax event

         setTimeout(function(LinelistMasterRecord,data,cnt,dcnt){
          Upload(LinelistMasterRecord,data,cnt,dcnt); 
         },1500,LinelistMasterRecord,data,cnt,dcnt);

      };

      for(var si in SetContent)
      {
        var civ = SetContent[si];
        SetContent[si]['LinelistMasterRecord'] = LinelistMasterRecord;
      }

      postUrl = site_url+'linelist/index/importdata';
      // console.log(SetContent);
      submitFormData(postUrl,SetContent,PostimportResult,false,true,0);

      var skipLoop = setTimeout(function(LinelistMasterRecord,data,cnt,dcnt){
        var SetContent = data[cnt];

        for(var pk in SetContent)
        {
            $("td[id='RowDataRemarks_"+pk+"']").html("Unable to Process Request");
            $("span[id='LinelistRecord_Failed']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) + 1 );
            $("span[id='LinelistRecord_Failed2']").text( parseInt($("span[id='LinelistRecord_Failed']").text()) );
            $("td[id='RowDataStatus_"+pk+"']").html('<i class="fa fa-times text-danger mr-5"></i>Data Import Failed!').attr("title",'Unable to Process Request');
            $("tr[id='llr_"+pk+"']").addClass('failedUpload');
        }

        cnt++; // Will be moved inside ajax event

        
        Upload(LinelistMasterRecord,data,cnt,dcnt); // Will be moved inside ajax event

      },600000,LinelistMasterRecord,data,cnt,dcnt);

    }
    else
    {
      $("span[name='importDisplay'][id='Status']").text('All '+parseInt($("span[id='LinelistRecord_ToUpload']").text())+' Linelist Record successfully processed, please review the List for Status and Remarks');
      $("i[id='xlsstatusLoader']").hide();
      $("button[id='BrowseFile'][name='fuButtons'], button[id='CloseUpload'][name='fuButtons']").removeAttr('disabled','disabled').show();
      $("button[id='StopUpload'][name='fuButtons']").attr('disabled','disabled').hide();

      Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-dark',
            cancelButton: 'btn btn-secondary',
          },
          buttonsStyling: false,
          onBeforeOpen: (fnRun) => {
            $(".swal2-container").css('z-index',$.topZIndex());
          }
        }).fire({
          title: 'Linelist Data Import',
          html: 'Linelist Import successfully Completed,  please review the Downloaded List for Status and Remarks ',
          icon: 'success',
          showConfirmButton:true,
          confirmButtonText: 'Close',
          showCancelButton: false,
          cancelButtonText: "Close",  
          reverseButtons: false,
        }).then((result) => {
            var FileXname = ($("span[name='importDisplay'][id='FileName']:first").text()).replace('.xlsx','');
            FileXname = FileXname.replace('.xls','');
            $("table[id='FileBrowseContent']").table2excel({
                name: "Linelist Import Result",
                filename: "Linelist Import Result - "+FileXname //do not include extension
            }); 

            oTable_Obj['linelist_List'].draw(); 
        });
    }
  }
  else
  {
    $("span[name='importDisplay'][id='Status']").text('Linelist Uploading successfully stopped at record '+(dcnt+1)+', please download and review status and results!');
    $("button[id='StopUpload'][name='fuButtons']").attr('disabled','disabled').hide();
    $("button[id='BrowseFile'][name='fuButtons'],button[id='CloseUpload'][name='fuButtons']").removeAttr('disabled').show();
    $("i[id='xlsstatusLoader']").hide();

    Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-dark',
          cancelButton: 'btn btn-secondary',
        },
        buttonsStyling: false,
        onBeforeOpen: (fnRun) => {
          $(".swal2-container").css('z-index',$.topZIndex());
        }
      }).fire({
        title: 'Linelist Data Import',
        html: 'Linelist Import Interrupted,  please review the Downloaded List for Status and Remarks ',
        icon: 'error',
        showConfirmButton:true,
        confirmButtonText: 'Close',
        showCancelButton: false,
        cancelButtonText: "Close",  
        reverseButtons: false,
      }).then((result) => {
          var FileXname = ($("span[name='importDisplay'][id='FileName']:first").text()).replace('.xlsx','');
          FileXname = FileXname.replace('.xls','');
          $("table[id='FileBrowseContent']").table2excel({
              name: "Linelist Import Result",
              filename: "Linelist Import Result - "+FileXname //do not include extension
          }); 
          oTable_Obj['linelist_List'].draw(); 
      });
  }
}

function vrowdetails(dindex)
{
    var rDetails = '<table class="table table-sm table-striped mb-0">';
    var dlist = window.xFileDataRowDetails[btoa(dindex)];
    for(var fld in dlist)
    {
        rDetails += '<tr><td class="text-uppercase text-left font-size-10 " style="width:30%">'+dlist[fld]['Caption']+'</td><td class="text-center font-size-10 " style="width:2%">:</td><td class="text-left font-size-10 text-uppercase" style="width:68%">'+dlist[fld]['Value']+'</td></tr>';
    }
    rDetails += '</table">';

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
      html: '<h5>VACCINEE DETAILS</h5><div class="border p-5">'+rDetails+'</div>',
      width : 600,
      // icon: 'error',
      confirmButtonText: 'Close',
    });

}