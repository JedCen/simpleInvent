<head>
    <meta charset="UTF-8">
    <title> Inventario - <?php echo $__env->yieldContent('htmlheader_title', 'Your title here'); ?> </title>
    <meta name="description" content="Admin invoice">
    <meta name="author" content="Jed Cen">
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->yieldContent('template_linked_css'); ?>
    <!-- Theme style -->
    <link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet">
    
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style type="text/css">
            <?php echo $__env->yieldContent('template_fastload_css'); ?>

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->



    <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
    </script>


</head>
