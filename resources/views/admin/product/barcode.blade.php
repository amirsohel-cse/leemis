<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<style>
 
            
            table tr:nth-of-type(5n) {
                page-break-after: always;
            }
            
            table tr:first-child td {
                padding-top: 0 !important;
            }
            
            @page { margin: -10px; padding:0px }
body { margin: -10px; padding:0px; }
            

            
</style>
<body>

<?= $request->html ?>

</body>
</html>