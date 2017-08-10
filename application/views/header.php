<!DOCTYPE html>

<html class="no-js" lang="en"> <!--<![endif]-->

<head>

<title> Invoice | <?php echo ($title) ? $title : ''; ?></title>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="NOINDEX,NOFOLLOW">

<link rel="icon" type="image/png" href="assets/core/img/favicon.png">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


<link rel="stylesheet" href="<?php echo base_url();?>assets/invoiceplane/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/core/css/custom.css">

<!-- dataTables css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css">


<script src="<?php echo base_url();?>assets/core/js/dependencies.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    Dropzone.autoDiscover = false;

    $(function () {
        $('.nav-tabs').tab();
        $('.tip').tooltip();

        $('body').on('focus', ".datepicker", function () {
            $(this).datepicker({
                autoclose: true,
                format: 'mm/dd/yyyy',
                language: 'en',
                weekStart: '0',
                todayBtn: "linked"
            });
        });

        $(document).on('click', '.create-invoice', function () {
            $('#modal-placeholder').load("invoices/ajax/modal_create_invoice");
        });

        $(document).on('click', '#btn_quote_to_invoice', function () {
            var quote_id = $(this).data('quote-id');
            $('#modal-placeholder').load("quotes/ajax/modal_quote_to_invoice/" + quote_id);
        });

    });
</script>

</head>
<body class="hidden-sidebar">

<noscript>
    <div class="alert alert-danger no-margin">Please enable Javascript to use InvoicePlane</div>
</noscript>

<?php include 'menu.php';