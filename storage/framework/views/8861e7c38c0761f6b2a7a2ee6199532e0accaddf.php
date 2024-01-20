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


    <title>Laravel Starter Template</title>
    

    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
</head>
<body>    
    <div id="app">    
        
    </div>
</body>
</html>
<?php /**PATH /Users/deepakdebnath/Downloads/buildmax-local/resources/views/app.blade.php ENDPATH**/ ?>