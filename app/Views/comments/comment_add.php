<?php
/*
 * Project-name: devqualimp
 * File-name: comment_add.php
 * Author: WU
 * Start-Date: 2023/8/22 10:58
 */

?>
<h1>模具维修台账登记</h1>
<br/>
<?= validation_list_errors()?>
<div class="container" style="width: 100vw;">
    <form class="form" method="post" action="comment_add" style="width: 60%;float: left">
        <?= csrf_field()?>
        <table class="table" style="border: 1px solid #000;text-align: center;width: 100%">
            <tbody>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">工厂</th>
                <td style="border: 1px solid #000;">
                    <select class='form-select' name='sel_factory' id='sel_factory'>
                        <?php foreach ($adrs as $adr): ?>
                            <option value="<?= $adr['id']; ?>" <?php if ($adr['default'] == 1) echo 'selected'; ?> ><?= $adr['adresse'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">模具名称</th>
                <td style="border: 1px solid #000;"><textarea class="text-lg-left" style="width: 100%;" id="mold_name" name="mold_name"></textarea></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">资产号</th>
                <td style="border: 1px solid #000;"><input class="text-lg-left" style="width: 100%;" id="asset_number" name="asset_number" /></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">购买日期</th>
                <td style="border: 1px solid #000"><input type="date" style="width: 100%" id="purchase_date" name="purchase_date" value="<?=date('Y-m-d')?>" /></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000">模具编号</th>
                <td style="border: 1px solid #000"><textarea style="width: 100%" data-am-md aria-readonly="true" aria-disabled="true"></textarea></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">模具数量</th>
                <td style="border: 1px solid #000"><input style="width: 100%" type="number" class="number" id="mold_quantity" name="mold_quantity" min="0" /></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">问题点</th>
                <td style="border: 1px solid #000"><input type="hidden" name="ask_note" /><div id="div_question" style="text-align: left"></div></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">进度</th>
                <td style="border: 1px solid #000"><input type="hidden" name="schedule_note" /><div id="div_schedule" style="text-align: left"></div></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">处理结果</th>
                <td style="border: 1px solid #000"><input type="hidden" name="result_note" /><div id="div_result" style="text-align: left"></div></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">预计发货日期</th>
                <td style="border: 1px solid #000"><input style="width: 100%" type="date" id="reception_date" name="reception_date" value="<?=date('Y-m-d')?>"/></td>
            </tr>
            <tr>
                <th style="border: 1px solid #000;width: 25%;">预计收货日期</th>
                <td style="border: 1px solid #000"><input style="width: 100%" type="date" id="dispatch_date" name="dispatch_date" value="<?=date('Y-m-d')?>"/></td>
            </tr>
            <tr>
                <td style="text-align: center;border: 1px solid #000000;"><button type="reset" class="text-reset">清空内容</button></td>
                <td style="text-align: center;border: 1px solid #000000;"><input type="hidden" id="client" name="client" value="<?= $client ?>"/><button type="submit" class="btn-success">保存这条记录</button></td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="success" style="float: right;width: 35%">
        <?php if (isset($success) && $success === '1'):?>
            <div class='alert alert-success' role='alert'>
                你刚刚成功的添加了一条模具维修的台账信息
            </div>
        <?php endif;?>
    </div>
</div>
<script>

    document.title = '模具维修台账登记';
    // markdown
    $(function () {
        /*
        var md_question = editormd('div_schedule', {
            path: "./asset/editormd/lib/",
            toolbarIcons: function () {
                return ['bold', 'del', 'italic', 'quote', 'uppercase', 'lowercase', '|',
                    'h1', 'h2', 'h3', 'h4', '|',
                    'list-ul', 'list-ol', 'hr', '|',
                    'watch', 'preview', 'fullscreen', '|',
                    'help'];
            }
        })
        */
    })

    const question_editor = pell.init({
        element :document.getElementById('div_question'),
        defaultParagraphSeparator: 'div',
        styleWithCSS: true,
        onChange: () => {
            $("input[name='ask_note']").val($('#div_ask_note').html());
        },
        actions:[
            {
                name : 'small-font',
                icon : '小',
                title: 'Small Font',
                result : () => pell.exec('FontSize','1')
            },
            {
                name : 'middle-font',
                icon : '中',
                title: 'Middle Font',
                result : () => pell.exec('FontSize','2')
            },
            {
                name : 'big-font',
                icon : '大',
                title: 'Big Font',
                result : () => pell.exec('FontSize','4')
            },
            'bold',
            'underline',
            'italic',
            // 'strikethrough',
            {
                name : 'red',
                icon : '<font color="red">R</font>',
                title : 'Red Font',
                result : () => pell.exec('ForeColor','#FF0000')
            },
            {
                name : 'green',
                icon : '<font color="green">G</font>',
                title : 'Green Font',
                result : () => pell.exec('ForeColor','#00FF00')
            },
            {
                name : 'back black',
                icon : 'Bb',
                title : 'Back Black',
                result : () => pell.exec('ForeColor','#000000')
            },
            'heading1',
            'heading2',
            'paragraph',
            'olist',
            'ulist',
            'line'
        ],
        classes: {
            actionbar: 'pell-actionbar',
            button: 'pell-button',
            content: 'pell-content',
            selected: 'pell-button-selected'
        }
    })
    question_editor.content.id = 'div_ask_note';
    question_editor.content.style = 'height:250px;font-size:1em;';
    question_editor.content.innerHTML = '';

    const schedule_editor = pell.init({
        element :document.getElementById('div_schedule'),
        defaultParagraphSeparator: 'div',
        styleWithCSS: true,
        onChange: () => {
            $("input[name='schedule_note']").val($('#div_schedule_note').html());
        },
        actions:[
            {
                name : 'small-font',
                icon : '小',
                title: 'Small Font',
                result : () => pell.exec('FontSize','1')
            },
            {
                name : 'middle-font',
                icon : '中',
                title: 'Middle Font',
                result : () => pell.exec('FontSize','2')
            },
            {
                name : 'big-font',
                icon : '大',
                title: 'Big Font',
                result : () => pell.exec('FontSize','4')
            },
            'bold',
            'underline',
            'italic',
            // 'strikethrough',
            {
                name : 'red',
                icon : '<font color="red">R</font>',
                title : 'Red Font',
                result : () => pell.exec('ForeColor','#FF0000')
            },
            {
                name : 'green',
                icon : '<font color="green">G</font>',
                title : 'Green Font',
                result : () => pell.exec('ForeColor','#00FF00')
            },
            {
                name : 'back black',
                icon : 'Bb',
                title : 'Back Black',
                result : () => pell.exec('ForeColor','#000000')
            },
            'heading1',
            'heading2',
            'paragraph',
            'olist',
            'ulist',
            'line'
        ],
        classes: {
            actionbar: 'pell-actionbar',
            button: 'pell-button',
            content: 'pell-content',
            selected: 'pell-button-selected'
        }
    })
    schedule_editor.content.id = 'div_schedule_note';
    schedule_editor.content.style = 'height:250px;font-size:1em;';
    schedule_editor.content.innerHTML = '';

    const result_editor = pell.init({
        element :document.getElementById('div_result'),
        defaultParagraphSeparator: 'div',
        styleWithCSS: true,
        onChange: () => {
            $("input[name='result_note']").val($('#div_result_note').html());
        },
        actions:[
            {
                name : 'small-font',
                icon : '小',
                title: 'Small Font',
                result : () => pell.exec('FontSize','1')
            },
            {
                name : 'middle-font',
                icon : '中',
                title: 'Middle Font',
                result : () => pell.exec('FontSize','2')
            },
            {
                name : 'big-font',
                icon : '大',
                title: 'Big Font',
                result : () => pell.exec('FontSize','4')
            },
            'bold',
            'underline',
            'italic',
            // 'strikethrough',
            {
                name : 'red',
                icon : '<font color="red">R</font>',
                title : 'Red Font',
                result : () => pell.exec('ForeColor','#FF0000')
            },
            {
                name : 'green',
                icon : '<font color="green">G</font>',
                title : 'Green Font',
                result : () => pell.exec('ForeColor','#00FF00')
            },
            {
                name : 'back black',
                icon : 'Bb',
                title : 'Back Black',
                result : () => pell.exec('ForeColor','#000000')
            },
            'heading1',
            'heading2',
            'paragraph',
            'olist',
            'ulist',
            'line'
        ],
        classes: {
            actionbar: 'pell-actionbar',
            button: 'pell-button',
            content: 'pell-content',
            selected: 'pell-button-selected'
        }
    })

    result_editor.content.id = 'div_result_note';
    result_editor.content.style = 'height:250px;font-size:1em;';
    result_editor.content.innerHTML = '';
</script>