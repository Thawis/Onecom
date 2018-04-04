<!--<html>
<head>
    <title></title>
</head>
<body>
        <select>
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
    </select>

    <button type="button" id="btn1" name="btn1">OK</button>
    <button type="button" id="btn2" name="btn2">Cancel</button>
    <input type="text" id="type" name="type">
    <button type="button" id="btn3" name="btn3">Clear</button>


    <script src="plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script>
        $('#btn1').on('click', function () {
            var type = "type";
            loadData(type);
        });
        $('#btn2').on('click', function () {
            var type = "subtype";
            loadData(type);
        });
        function loadData(type) {
            $.ajax({
                url: "view_admin/ajax/test.php",
                type: "get",
                async: true,
                data: {type: type},
                success: function (data) {
                    $('#type').val(data);
                }
            });
        };
        $('#btn3').on('click', function(){
            $('#type').val("");
        });

//            var response = $.ajax({type: "GET",
//                url: "view_admin/ajax/test.php",
//                async: false
//            }).responseText;
//            alert(response);
    </script>

</body>
</html>-->
<?php
include 'lib/connect.php';
$sql =  'select * from t_employee';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->fetch();

echo $rows['Emp_Birthday']

?>
<html>
    <head>
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
<!--        <button type="button" id="btn1" name="btn1">OK</button>

        <div class="form-group">
            <label>Select</label>
            <select class="form-control" id="test1">
            </select>
        </div>
        <script src="plugins/jQuery/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script>
            $(function () {
                $.ajax({
                    url: 'view_admin/ajax/test.php',
                    dataType: 'JSON',
                    success: function (data) {
                        //$select.html('');
                        //iterate over the data and append a select option
                        //var op = $.parseJSON(data);
                        $.each(data, function (key, val) {
                            $('#test1').append('<option id="' + val.id + '">' + val.name + '</option>');
                        })
                    }
                });
            });

        </script>-->
<div class="text-center">
    <button id="" style="margin-right: 5px;" class="btn-xs btn btn-warning btn-edit"> <span class="fa fa-gears"></span>แก้ไขรายละเอียด</button>
    <button id="" style="margin-right: 5px;" class="btn-xs btn btn-danger btn-del-del" data-toggle="modal" data-target="#myModal-CD"> <span class="fa fa-close"></span>ยกเลิกรายการ</button>
    <button id="" style="margin-right: 5px;" class="btn-xs btn btn-info btn-del-detail" data-toggle="modal" data-target="#myModal-CD"> <span class="fa fa-tasks"></span>รายละเอียด</button>
</div>


    </body>
</html>

