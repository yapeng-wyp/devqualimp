<?php
/*
 * Project-name: devqualimp
 * File-name: commend_pdf.php
 * Author: WU
 * Start-Date: 2023/8/28 17:10
 */
?>

<!doctype html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content="width=device-width, initial-scale=1">
    <title>模具维修台账</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        * {
            font-family:simsun;
        }

        h2 {
            font-size: 24px;
        }

        table {
            width: 100%;
        }

        table th {
            background: #ddd !important;
            color: #000 !important;
            border: 1px solid #000 !important;
            text-align: center !important;
            vertical-align: middle !important;
            font-size: 12px;
        }

        table td {
            text-align: center !important;
            border: 1px solid #000;
            margin: 2px;
            font-size: 12px;
            word-wrap: break-word;
            word-break: break-all;
        }

    </style>
</head>

<body>
<div class="container">
        <img src="<?=$logo?>" width="75" height="50" alt="logo"/>
        <center><h2>模具维修台账</h2></center>
    <table class="table table-striped table-bordered" style="border: 1px solid #000;" cellspacing="0">
        <thead>
        <tr>
            <th>工厂地址</th>
            <th>模具名称</th>
            <th>资产号</th>
            <th>购买日期</th>
            <th>数量</th>
            <th>维修时间</th>
            <th>问题点</th>
            <th>进度</th>
            <th>处理结果</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($lists) > 0) {
            foreach ($lists as $index => $list) {
                ?>
                <tr>
                    <td><?=$list['factory_name']?></td>
                    <td><?=$list['name']?></td>
                    <td><?=$list['assetnum']?></td>
                    <td><?=$list['datebought']?></td>
                    <td><?=$list['quantite']?></td>
                    <td>维修时间存在疑虑</td>
<!--                    <td><p>--><?//=$list['questions']?><!--</p></td>-->
                    <td style="width: 200px"><p><?=strip_tags($list['questions'],'<br>')?></p></td>
<!--                    <td><p>--><?//=$list['schedule']?><!--</p></td>-->
                    <td style="width: 200px"><p><?=strip_tags($list['schedule'],'<br>')?></p></td>
<!--                    <td><p>--><?//=$list['final']?><!--</p></td>-->
                    <td style="width: 200px"><p><?=strip_tags($list['final'],'<br>')?></p></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>
</body>

</html>
