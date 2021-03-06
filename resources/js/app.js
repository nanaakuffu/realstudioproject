require("./bootstrap");

import $ from "jquery";
window.$ = window.jQuery = $;

import "jquery-ui/ui/widgets/datepicker.js";
import "admin-lte/plugins/datatables/jquery.dataTables.min.js";
import "admin-lte/plugins/jquery-validation/jquery.validate.min.js";
import "admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js";
import "admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js";
import "admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js";
import "admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js";
import "admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js";
import "admin-lte/plugins/jszip/jszip.min.js";
import "admin-lte/plugins/pdfmake/pdfmake.min.js";
import "admin-lte/plugins/pdfmake/vfs_fonts.js";
import "admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js";
import "admin-lte/plugins/datatables-buttons/js/buttons.print.min.js";
import "admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js";
import "admin-lte/plugins/select2/js/select2.full.min.js";
import "admin-lte/plugins/toastr/toastr.min.js";

// Import local js codes
// import "./../../resources/js/company";

//Don't forgot to put code also same as below otherwise it will not working

// Datepicket Code
$("#datepicker").datepicker();

//Datatable
// $("#companyTable")
//     .DataTable({
//         responsive: true,
//         lengthChange: false,
//         paging: true,
//         searching: true,
//         ordering: true,
//         info: true,
//         autoWidth: false,
//         responsive: true,
//         buttons: ["copy", "csv", "excel", "pdf", "print"],
//     })
//     .buttons()
//     .container()
//     .appendTo("#companyTable_wrapper .col-md-6:eq(0)");

//Initialize Select2 Elements
$(".select2").select2();

//Initialize Select2 Elements
$(".select2bs4").select2({
    theme: "bootstrap4",
});
// ..........similarly other scripts comes
