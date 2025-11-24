<?php require "./header.php" ?>
<div class="main">
    <div class="main-content dashboard">
        <a href="./index.php?act=thongke" class="mb-4">
            <button class="btn btn-primary">Thống kê theo danh sách</button>
        </a>
        <span class="<?= isset($_COOKIE['notification']) ? "noti-success" : "" ?> ">
            <?= $notification = isset($_COOKIE['notification']) ? $_COOKIE['notification'] : ""; ?>
        </span>


        <?php

                    $doanhthu = doanhthu_thang();
        foreach ($doanhthu as $key) {
            $thang[]= $key['thang'];
            $nam[] = $key['nam'];
            $doanhthuthang[]=$key['doanhthuthang'];
            $soluongdonhang[] = $key['soluongdonhang'];
        }
        $labels = [];
        foreach ($thang as $index => $month) {
          $labels[] = $month . '-' . $nam[$index];  // Tạo label theo định dạng "YYYY-MM-DD"
      };
        ?>






        <div class="container" style='width:100%;'>
    <canvas id="myChart"></canvas>
        </div>
        <script>
            $('#example').DataTable();
        </script>



  <script>
    let myChart = document.getElementById('myChart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let massPopChart = new Chart(myChart, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo json_encode($labels)?>,
        datasets:[{
          label:'doanh thu',
          data:<?php echo json_encode($doanhthuthang)?>,
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(153, 102, 255, 0.6)',
            'rgba(255, 159, 64, 0.6)',
            'rgba(255, 99, 132, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
        }]
      },
      options:{
        title:{
          display:true,
          text:'thống kê doanh thu theo tháng',
          fontSize:25
        },
        legend:{
          display:true,
          position:'right',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
  
        tooltips:{
          enabled:true,
          callbacks: {
            label: function(tooltipItem, data) {
            var soluongdonhang = <?php echo json_encode($soluongdonhang); ?>;
              return 'Doanh thu: ' + tooltipItem.yLabel.toLocaleString('vi-VN') +' số lượng đơn: ' + soluongdonhang[tooltipItem.index] ;
          }
      }
        }
      }
    });
  

</script>

    </div>
</div>

<div class="overlay"></div>
<?php require "./footer.php" ?>


