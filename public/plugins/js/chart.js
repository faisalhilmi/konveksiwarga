$(function () {
  var base_url = window.location.origin;
  $("#chart-e").hide();
  $("#line-e").hide();
  $.ajax({
    method: 'GET',
    type: 'json',
    url: base_url + '/admin/chart/column',
    success: function(result){
      var chart = new Highcharts.Chart({
        chart: {
          renderTo: 'chart',
          type: 'column',
          marginRight: 130,
          marginBottom: 25
        },
        title: {
          text: 'Komoditi Khusus',
                    x: -20 //center
                  },
                  subtitle: {
                    text: '',
                    x: -20
                  },
                  xAxis: {
                    categories: ['Produk Komoditi Khusus']
                  },
                  yAxis: {
                    title: {
                      text: 'Jumlah'
                    },
                    plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                    }]
                  },
                  tooltip: {
                    formatter: function() {
                      return '<b>'+ this.series.name+'</b><br/>'+
                      this.x +': '+ this.y +'<br>Harga: '+ this.series.options.price;
                    }
                  },
                  legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                  },
                  series: result.serial
                });
    }
  });

  $.ajax({
    method: 'GET',
    type: 'json',
    url: base_url + '/admin/chart/line',
    success: function(result){
      var chart = new Highcharts.Chart({
        chart: {
          renderTo: 'line',
          type: 'column',
          marginRight: 130,
          marginBottom: 25
        },
        title: {
          text: 'Komoditi Umum',
                    x: -20 //center
                  },
                  subtitle: {
                    text: '',
                    x: -20
                  },
                  xAxis: {
                    categories: ['Produk Komoditi Umum']
                  },
                  yAxis: {
                    title: {
                      text: 'Jumlah'},
                    plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                    }]
                  },
                  tooltip: {
                    formatter: function() {
                      return '<b>'+ this.series.name +'</b><br/>'+
                      this.x +': '+ this.y +'<br>Harga: '+ this.series.options.price;;
                    }
                  },
                  legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                  },
                  series: result
                });
    }
  });

  $('#cari-khusus').click(function(e){
    e.preventDefault();
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: base_url + '/admin/chart/column-cari',
      data: $("#form-khusus").serialize(),
      success: function(result){
        $('#chart-e').show();
        $('#chart').hide();

        var chart = new Highcharts.Chart({
          chart: {
            renderTo: 'chart-e',
            type: 'column',
            marginRight: 130,
            marginBottom: 25
          },
          title: {
            text: 'Komoditi Khusus',
                    x: -20 //center
                  },
                  subtitle: {
                    text: '',
                    x: -20
                  },
                  xAxis: {
                    categories: ['Produk Komoditi Khusus']
                  },
                  yAxis: {
                    title: {
                      text: 'Jumlah'
                    },
                    plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                    }]
                  },
                  tooltip: {
                    formatter: function() {
                      return '<b>'+ this.series.name +'</b><br/>'+
                      this.x +': '+ this.y +'<br>Harga: '+ this.series.options.price;;
                    }
                  },
                  legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                  },
                  series: result.serial
                });
      }
    }); 

  });

  $('#cari-umum').click(function(e){
    e.preventDefault();
    $.ajax({
      type: 'GET',
      dataType: 'json',
      url: base_url + '/admin/chart/line-cari',
      data: $("#form-umum").serialize(),
      success: function(result){
        $('#line-e').show();
        $('#line').hide();

        var chart = new Highcharts.Chart({
          chart: {
            renderTo: 'line-e',
            type: 'column',
            marginRight: 130,
            marginBottom: 25
          },
          title: {
            text: 'Komoditi Umum',
                    x: -20 //center
                  },
                  subtitle: {
                    text: '',
                    x: -20
                  },
                  xAxis: {
                    categories: ['Produk Komoditi Umum']
                  },
                  yAxis: {
                    title: {
                      text: 'Jumlah'
                    },
                    plotLines: [{
                      value: 0,
                      width: 1,
                      color: '#808080'
                    }]
                  },
                  tooltip: {
                    formatter: function() {
                      return '<b>'+ this.series.name +'</b><br/>'+
                      this.x +': '+ this.y +'<br>Harga: '+ this.series.options.price;;
                    }
                  },
                  legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                  },
                  series: result.serial
                });
      }
    }); 

  });

});