const url = $("meta[name=base_url]").attr('content');

function networkStatus(){
    $.ajax({
        url: 'networkStatus',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {
            //C
            var str = data.datos.btc.hashrate.toString();

            var num = str.substr(0, 3);
            num = parseInt(num)

            var n = num/10;
            $("#_pool_red").html(n+'EH/s'); //network status
        }
    });
}

function hashRate(){
    $.ajax({
        url: 'https://us-pool.api.btc.com/v1/pool/multi-coin-stats?dimension=1h',
        type: 'get',
        dataType: "json",
        //data:{},
        success: function(data) {

            //C
            var num=data.data.btc.stats.shares.shares_15m;

            $("#_pool_red").html(num.toFixed(2)+' <span id="_pool_red_label" class="font-14 font-light col-3"> PH/s</span> '); //estimado hoy 
            //$("#_bar_red").css('width', ((data.datos.btc.stats.shares.shares_15m*100)/7)+'%')
        }
    });
}

hashRate();

function _load(){
    hashRate();
}

setInterval(_load, 20000);

