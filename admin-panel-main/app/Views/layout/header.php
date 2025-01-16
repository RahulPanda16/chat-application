<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta http-equiv="Content-Language" content="en"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <title>Admin Panel</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" /> 
    <meta name="msapplication-tap-highlight" content="no"> 
    <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet"> 
    <link href="<?= base_url('assets/css/main.css'); ?>" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <!-- <link href="<?= base_url('assets/css/remixicon.css'); ?>" rel="stylesheet">  -->
    <link href="<?= base_url('assets/css/fontAwesome.css'); ?>" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
    <link href="<?= base_url('assets/css/jqueryTheme.css'); ?>" rel="stylesheet"> 
    <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  -->
    <script src="<?= base_url('assets/js/jquery.js'); ?>"></script> 
    <script src="<?= base_url('assets/js/jqueryModal.js'); ?>"></script>

    <style>  
        body{
            position: relative;
            font-family: "Open Sans", serif;
            background-color:#f1f1f1;
        }
        .logo img{
            border-radius:51px;
            height:80px;
            width: 100px;
            margin-bottom:-30px ;
            position:absolute;
            left:1.7%;
            top:-20%;
        }

        .modal {
            position: absolute;
            left:35%;
            z-index: 9999999999;
            top: 15%;
            width: 550px;
            height: 520px;
            line-height: 1.25;
            text-decoration: none;
            border: 2px solid #c7c7c7;
            border-radius:  26px;
            box-shadow:1px 1px 5px rgba(0,0,0,0.5);
        }

        .modal1 {
            top: -25px;
            width: 550px;
            height: 700px;
            /* line-height: 1.25; */
            text-decoration: none;
            text-indent: 0;
            border: 2px solid #c7c7c7;
            border-radius:  26px;
            box-shadow:1px 1px 5px rgba(0,0,0,0.5);
        }

        .modal2{
            /* top: -25px; */
            width: 550px;
            height: 600px;
            /* line-height: 1.25; */
            text-decoration: none;
            text-indent: 0;
            border: 2px solid #c7c7c7;
            border-radius:  26px;
            box-shadow:1px 1px 5px rgba(0,0,0,0.5);
        }

        .modalDeleteCampaign, .modalDeleteUser{
            /* top: -25px; */
            width: 100%;
            height: 200px;
            /* line-height: 1.25; */
            text-decoration: none;
            text-indent: 0;
            border: 2px solid #c7c7c7;
            border-radius:  26px;
            box-shadow:1px 1px 5px rgba(0,0,0,0.5);
        }

        .modalRole{
            width: 100%;
            height: 350px;
            text-decoration: none;
            text-indent: 0;
            border: 2px solid #c7c7c7;
            border-radius:  26px;
            box-shadow:1px 1px 5px rgba(0,0,0,0.5);
        }

        .pager{
            /* background-color: #c7c7c7; */
            position: absolute;
            right:0;
            padding-right: 20px;
        }
    </style>
    <script>
    $(document).on('click', '.editRole', function() {
        var roleId = $(this).closest('tr').find('td:first').text().replace('#', '').trim(); // Get the role ID
        var roleName = $(this).closest('tr').find('.widget-heading').text(); // Get the role name

        $('.updateId').val(roleId);

        $('#inlineFormCustomSelectPref').val(roleName).change();
    });

    $(document).on('click', '.editRole', function() {
        var id = $(this).closest('tr').find('td:first').text().replace('#', '').trim(); 
        $.ajax({
            url: "<?php echo base_url(); ?>/getSingleRole/" + id, 
            method: "GET",
            success: function(result) {
                var res = JSON.parse(result);
                $(".updateId").val(res.id);
                $("select[name='role']").val(res.role); 
            }
        });
    });

    </script>
</head>

<body>
    