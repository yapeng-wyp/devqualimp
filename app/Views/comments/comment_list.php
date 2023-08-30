<?php
/*
 * Project-name: devqualimp
 * File-name: comment_list.php
 * Author: WU
 * Start-Date: 2023/8/25 15:41
 */

?>
<div class="d-print-block text-right" style="margin-right: 20px">
    <a href="<?php echo base_url('generate-pdf') ?>" class='btn btn-info pull-right' style="margin-top:7px;margin-right: 5px">
        Download PDF
    </a>
    &nbsp;
    <a href="<?php echo base_url('generate-excel') ?>" class='btn btn-info pull-right' style="margin-top:7px;margin-right: 15px">
        Download Excel
    </a>
</div>
<br>
<br>
<div class="clearfix"></div>
<div class="glyphicon-filter" style="width: 50%">
    <?= validation_list_errors()?>
    <form class="form" method="post" action="comment_filter" >
        <?= csrf_field()?>
        <table class="table table-bordered">
            <tr>
                <th class="table-h">查询月份</th>
                <td><input type="text" class="datepicker" data-date-format="Y-mm-D" value="<?=date('Y-m-d')?>" id="start_date" name="start_date" /> ~ <input type="text" class="datepicker" data-date-format="Y-mm-D" value="<?=date('Y-m-d')?>" id="end_date" name="end_date"/></td>
            </tr>
            <tr>
                <th>工厂选择</th>
                <td>
                    <select class="form-select" id="sel_fac">
                        <option value="0">ALL</option>
                        <option value="1">YANGZHOU</option>
                        <option value="2">SUZHOU</option>
                        <option value="3">HANGZHOU</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>资产号</th>
                <td><input type="text" name="asset_num" /></td>
            </tr>
            <tr>
                <th>维修时间</th>
                <td>同样一个日期控件</td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><button type="submit" class="btn-success">提交查询</button></td>
            </tr>
        </table>
    </form>
</div>
<div class="clearfix"></div>

<div class="list-group">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th scope="col">工厂地址</th>
            <th scope="col">模具名称</th>
            <th scope="col">资产号</th>
            <th scope="col">购买日期</th>
            <th scope="col">数量</th>
            <th scope="col">维修时间</th>
            <th scope="col">问题点</th>
            <th scope="col">进度</th>
            <th scope="col">处理结果</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($lists)): foreach ($lists as $list): ?>
        <tr>
            <td><?=$list['factory_name']?></td>
            <td><?=$list['name']?></td>
            <td><?=$list['assetnum']?></td>
            <td><?=$list['datebought']?></td>
            <td><?=$list['quantite']?></td>
            <td>维修时间存在疑虑</td>
            <td><?=$list['questions']?></td>
            <td><?=$list['schedule']?></td>
            <td><?=$list['final']?></td>
        </tr>
        <?php endforeach;endif;?>
        </tbody>
    </table>
</div>

<script>
    document.title = '台账列表';
</script>

