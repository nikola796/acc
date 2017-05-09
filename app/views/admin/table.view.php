<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
</head>
<body>
<div style="margin:50px">

    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
        </tfoot>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            'processing': true,
            'serverSide': true,
            "ajax": {
                'url': "http://localhost/intranet_test/admin/table/get",
                'type': 'POST'
            }
        } );
    } );
</script>
</body>
</html>