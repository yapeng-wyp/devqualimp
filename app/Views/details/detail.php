<?php
/*
 * Project-name: devqualimp
 * File-name: detail.php
 * Author: WU
 * Start-Date: 2023/7/24 12:40
 */

use App\Models\ReparationMouleValeurModel; ?>



<?= validation_list_errors()?>
<!-- title -->
<div class="content">
    <div class="modal-title" style="text-align: center">
<!--        <h2>Filter</h2>-->
    </div>
    <div class="table" style="width: 100vw;margin-top: 25px;">
        <form action="/detail/filters" name="detail_filter" method="post" style="text-align: center">
            <?= csrf_field()?>
            <table class="table-bordered" style="width: 90%;margin: 0 auto">
                <thead>
                <tr>
                    <th class="form-label" >模具工厂</th>
                    <th class="form-label" >模具编号(我方)</th>
                    <th class="form-label" >模具编号(客户方)</th>
                    <th class="form-label" colspan="2" >到货日期</th>
                    <th class="form-label" colspan="2" >送货日期</th>
                    <th class="form-label" >操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <select class="form-select" name="sel_factory" id="sel_factory">
                            <?php foreach ($adrs as $adr):?>
                            <option value="<?= $adr['id'];?>" <?php if ($adr['default'] == 1) echo 'selected'; ?> ><?=$adr['adresse']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="form-text" name="moule_code" id="moule_code" placeholder="MTxxxxxx-xx" <?php if (isset($search)) echo $search['moule_code']; ?> /></td>
                    <td><input type="text" class="form-text" name="cli_moule_code" id="cli_moule_code" placeholder="VXBOxxxxx-xx" <?php if (isset($search)) echo $search['cli_moule_code']; ?> /></td>
                    <td><input type="date" class="form-control" name="reacp_date_min" id="reacp_date_min" /></td>
                    <td><input type="date" class="form-control" name="reacp_date_max" id="reacp_date_max" /></td>
                    <td><input type="date" name="bonlivraison_date_min" id="bonlivraison_date_min" class="form-control" /></td>
                    <td><input type="date" name="bonlivraison_date_max" id="bonlivraison_date_max" class="form-control" /></td>
                    <td><input type="submit" class="btn-dark" name="submit" /></td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div class="clearfix"></div>

    <div class="filter_result" style="height: 100vh;width:90vw;">
<!--        <div class='modal-title '><h3>查询结果</h3></div>-->

        <!-- display all data for this company-->
        <div class="container" id="container" >
            <table class="table-info table-bordered" style="margin: 0 auto;border: 1px solid #000">
                <thead>
                <tr class="text-center text-success">
                    <th rowspan="2"><label>服务商编码</label></th>
                    <th rowspan="2"><label>客户端编码</label></th>
                    <th rowspan="2"><label>资产号</label></th>
                    <th rowspan="2"><label>初始购买日期</label></th>
                    <th rowspan="2"><label>客户工厂</label></th>
                    <th colspan="2"><label>收货信息</label></th>
                    <th rowspan="2"><label>处理工序</label></th>
                    <th colspan="2"><label>发货信息</label></th>
                </tr>
                <tr class="text-center text-success">
                    <th><label>日期</label></th>
                    <th><label>图像</label></th>
                    <th><label>日期</label></th>
                    <th><label>图像</label></th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($searchdata)):?>

                <?php foreach ($all_data as $item):?>
                    <tr>
                        <td><?=$item->tracabiliteinterne;?></td>
                        <td><?=$item->tracabiliteclient;?></td>
                        <td><?=$item->assetnum;?></td>
                        <td><?=$item->datebought;?></td>
                        <td><?=$item->usine;?></td>
                        <td><?=$item->reception->date;?></td>
                        <td>
                            <?php if ($item->reception->file_path != ''): ?>
                                <img src="<?=QUALI_URL.$item->reception->file_path?>" class="img-thumbnail" style="width: 96px;height: 96px" onclick="showBig('<?=QUALI_URL.$item->reception->file_path?>')" />
                            <?php else:?>
                                <img src="/asset/media/images/empty.jpeg" class="img-thumbnail" style="width: 96px;height: 96px" />
                            <?php endif;?>
                        </td>
                        <td>
                            <ul>
                                <?php foreach ($rmval as $oper):?>
                                <li style="text-align: left"><?=$oper['code']?>---<?=$oper['description']?></li>
                                <?php endforeach;?>
                            </ul>
                        </td><!-- reparation operation -->
                        <td>
                            <?php if ($item->dispatch->date != ''): ?>
                                <?=$item->dispatch->date?>
                            <?php else:?>
                                <span class="text-danger">In Maintenance</span>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if ($item->dispatch->file_path != ''): ?>
                            <img src="<?=QUALI_URL.$item->dispatch->file_path?>" class="img-thumbnail" style="width: 96px;height: 96px" onclick="showBig('<?=QUALI_URL.$item->dispatch->file_path?>')" />
                            <?php else:?>
                            <img src="/asset/media/images/empty.jpeg" class="img-thumbnail" style="width: 96px;height: 96px" />
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
                <?php else:?>
                    <?php foreach ($searchdata as $item):?>
                    <tr>
                        <td><?=$item->tracabiliteinterne;?></td>
                        <td><?=$item->tracabiliteclient;?></td>
                        <td><?=$item->usine;?></td>
                        <td><?=$item->reception->date;?></td>
                        <td>
                            <?php if ($item->reception->file_path != ''): ?>
                                <img src="<?=QUALI_URL.$item->reception->file_path?>" class="img-thumbnail" style="width: 96px;height: 96px" />
                            <?php else:?>
                                <img src="/asset/media/images/empty.jpeg" class="img-thumbnail" style="width: 96px;height: 96px" />
                            <?php endif;?>
                        </td>
                        <td>
                            <div style="display: inline-block;width: 0;overflow-y: scroll;">
                            <ul>
                                <?php foreach ($rmval as $oper):?>
                                    <li style="text-align: left"><?=$oper['code']?>---<?=$oper['description']?></li>
                                <?php endforeach;?>
                            </ul>
                            </div>
                        </td><!-- reparation operation -->
                        <td>
                            <?php if ($item->dispatch->date != ''): ?>
                                <?=$item->dispatch->date?>
                            <?php else:?>
                                <span class="text-danger">In Maintenance</span>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if ($item->dispatch->file_path != ''): ?>
                                <img src="<?=QUALI_URL.$item->dispatch->file_path?>" class="img-thumbnail" style="width: 96px;height: 96px" onclick="showBig('<?=QUALI_URL.$item->dispatch->file_path?>')" />
                            <?php else:?>
                                <img src="/asset/media/images/empty.jpeg" class="img-thumbnail" style="width: 96px;height: 96px" />
                            <?php endif;?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </table>
            <!-- 遮罩 -->
            <div id="back-curtain" style="position: fixed;top:0;background:rgba(0,0,0,0.5);z-index: 998;width: 100%;display: none">
                <div id="image_div" style="position: absolute">
                    <img src="" id="big_image">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.title = '模具维修记录';
</script>