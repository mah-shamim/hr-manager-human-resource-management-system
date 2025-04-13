function printPageArea(areaID){
    var printContent = document.getElementById(areaID);
    var WinPrint = window.open('', '', 'width=900,height=650');

    var htmlToPrint = '' +
    '<style type="text/css">' +
    'table.payrollDatatableReportPaySlip {' +
      'border-collapse: collapse;border: 0' +
      '}'+
    'table.payrollDatatableReportPaySlip td, table.payrollDatatableReportPaySlip th {' +
    'padding: 6px 15px;' +
    '}' +
    'table.payrollDatatableReportPaySlip td, table.payrollDatatableReportPaySlip th {' +
    'border: 1px solid #ededed;border-collapse: collapse;' +
    '}' +
    'table.payrollDatatableReportPaySlip td.noborder {' +
    'border: none;padding-top: 40px;' +
    '}' +
    '</style>';

    htmlToPrint += printContent.innerHTML;

    WinPrint.document.write(htmlToPrint);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}