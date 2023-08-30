$(function(){
    $('#start_date').datetimepicker({
        format:'yyyy-mm-dd',//日期的格式
        minView:'month', //可以选择的最小视图
        initialDate:new Date(),//初始化显示的日期
        autoclose:true,//设置选择完日期或者时间之后，日否自动关闭日历
        todayBtn:true,//设置自动显示为今天
        clearBtn:false//设置是否清空按钮，默认为false
    });
    $('#end_date').datetimepicker({
        format:'yyyy-mm-dd',//日期的格式
        minView:'month', //可以选择的最小视图
        initialDate:new Date(),//初始化显示的日期
        autoclose:true,//设置选择完日期或者时间之后，日否自动关闭日历
        todayBtn:true,//设置自动显示为今天
        clearBtn:false//设置是否清空按钮，默认为false
    });
});
