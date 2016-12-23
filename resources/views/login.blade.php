<!DOCTYPE html>
<html>
<head>
    <title>PBN: Login</title>

    <base href="/">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/AdminLTE.min.css">

    <link rel="stylesheet" href="css/style.css">

    <script src="js/es6-shim/es6-shim.min.js"></script>
    <script src="js/systemjs/dist/system-polyfills.js"></script>

    <script src="js/core-js/client/shim.min.js"></script>
    <script src="js/zone.js/dist/zone.js"></script>
    <script src="js/reflect-metadata/Reflect.js"></script>
    <script src="js/systemjs/dist/system.src.js"></script>
    <script src="systemjs.config.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ng2-bootstrap/x.x.x/ng2-bootstrap.min.js"></script>

    <script>
        System.config({
            packages: {
                typescript: {
                    format: 'register',
                    defaultExtension: 'js'
                }
            }
        });
//        System.import('typescript/boot')
//                .then(null, console.error.bind(console));

        System.import('app').catch(function(err){ console.error(err); });
    </script>

</head>
<body class="hold-transition login-page">
<pbn-app>Loading...</pbn-app>
</body>
</html>