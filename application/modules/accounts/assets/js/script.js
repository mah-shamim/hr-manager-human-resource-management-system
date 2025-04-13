 "use strict"; 
function balanceSheetPrintPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

 "use strict"; 
function bnkRconReportPrintPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');

    var htmlToPrint = '' +
    '<style type="text/css">' +
    'table.datatableReport {' +
      'border-collapse: collapse;border: 0' +
      '}'+
    'table.datatableReport td, table.datatableReport th {' +
    'padding: 6px 15px;' +
    '}' +
    'table.datatableReport td, table.datatableReport th {' +
    'border: 1px solid #ededed;border-collapse: collapse;' +
    '}' +
    'table.datatableReport td.noborder {' +
    'border: none;padding-top: 50px;' +
    '}' +
    '</style>';

    htmlToPrint += printContent.innerHTML;

    WinPrint.document.write(htmlToPrint);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

 "use strict"; 
function fixedAssetPrintPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');

    var htmlToPrint = '' +
    '<style type="text/css">' +
    'table.datatableReport {' +
      'border-collapse: collapse;border: 0' +
      '}'+
    'table.datatableReport td, table.datatableReport th {' +
    'padding: 6px 15px;' +
    '}' +
    'table.datatableReport td, table.datatableReport th {' +
    'border: 1px solid #ededed;border-collapse: collapse;' +
    '}' +
    'table.datatableReport td.noborder {' +
    'border: none;padding-top: 50px;' +
    '}' +
    '</style>';

    htmlToPrint += printContent.innerHTML;

    WinPrint.document.write(htmlToPrint);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

 "use strict"; 
function incomeStatementPrintPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');

    var htmlToPrint = '' +
    '<style type="text/css">' +
    'table.datatableReport {' +
      'border-collapse: collapse;border: 0' +
      '}'+
    'table.datatableReport td, table.datatableReport th {' +
    'padding: 6px 15px;' +
    '}' +
    'table.datatableReport td, table.datatableReport th {' +
    'border: 1px solid #ededed;border-collapse: collapse;' +
    '}' +
    'table.datatableReport td.noborder {' +
    'border: none;padding-top: 50px;' +
    '}' +
    '</style>';

    htmlToPrint += printContent.innerHTML;

    WinPrint.document.write(htmlToPrint);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
