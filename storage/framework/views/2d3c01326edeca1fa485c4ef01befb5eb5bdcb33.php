<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="fav.png" sizes="32x32" />
    <link rel="icon" href="fav.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="fav.png" />
    <meta name="msapplication-TileImage" content="fav.png" />
   
    <meta name="title" content="BuildMax">
    <meta name="keywords" content="Building, Materials, Caribbean">
    <meta name="description" content="One-Stop Supplier of Building Materials to Caribbean">

    <title>BuildMAX | One-Stop Supplier of Building Materials to Caribbean</title>
    

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>    
    <div id="app">    
        
    </div>
</body>
</html>
<?php /**PATH /www/wwwroot/buildmaxshop/resources/views/app.blade.php ENDPATH**/ ?>