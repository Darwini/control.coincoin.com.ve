<?php
use App\Models\dompdf\src\Dompdf;
$mipdf = new DOMPDF();
$mipdf->set_paper("A4", "portrait");
ob_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Historial de Instalaciones</title>
		<style type="text/css">
			.row:after,.row:before {content:"";display:table;clear:both}
			.third{float:left;width:33.33333%}
			.border-orange {border: 1px solid orange;}
			.row { content:"";display:table;clear:both}
			.padding{ padding: 0.01em 16px}
			.table{border-collapse:collapse;border-spacing:0;width:100%;display:table}
			.bordered tr,.table tr{border-bottom:1px solid #ddd}
			.table tr:nth-child(odd){background-color:#fff}
			.table tr:nth-child(even){background-color:#f1f1f1}
			.centered tr th,.centered tr td{text-align:center}
			.table td,.table th,.table td,.table th{padding:8px 8px;display:table-cell;text-align:left;vertical-align:top}
			.table th:first-child,.table td:first-child,.table th:first-child,.table td:first-child{padding-left:16px}
			.tiny{ font-size: 10px; }
		</style>
	</head>
	
	<body>
		<div class="row padding" style="margin-top:10px;margin-bottom:20px;">
			<div class="third" style="text-align:center;">
				<small>
					República Bolivariana de Venezuela<br>
					Zona Industrial San Vicente II<br>
					CoinCoin
				</small>
			</div>
			<div class="third" style="left:0;">
				<img src="./assets/images/logoiniciotope.png" style="width:66%;">
			</div>
			<small class="third tiny" style="float:right;right:0;"><?php echo e(date('d/m/y h:i:s')); ?></small>
		</div>
		
		<div style="margin-top:25px;margin-bottom:25px;">
			<div style="margin:20px;text-align:center;">
				<h4><b>Historial General de Instalaciones</b></h4>
			</div>
		
			<?php if(isset($instalaciones) && count($instalaciones) > 0): ?>
			<table class="table tiny centered bordered" style="margin-top:30px;margin-bottom:30px;">
				<thead>
					<tr style="background-color:orange;color:black;">
						<th <?php echo e($i=1); ?>>#</th>
						<th>Cliente</th>
                        <th>Modelo</th>
                        <th>Serial Equipo</th>
                        <th>Serial Fuente</th>
                        <th colspan="4">Ubicación</th>
                        <th>Instalador</th>
                        <th>Fecha</th>
					</tr>
				</thead>

				<tbody>
					<?php $__currentLoopData = $instalaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instalacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i++); ?></td>
						
						<td>
							<?php echo e(isset($instalacion->userclient->username) ? $instalacion->userclient->username : ''); ?>

						</td>
						
						<td><?php echo e($instalacion->modelo); ?></td>
                        <td><?php echo e($instalacion->serial_equipo); ?></td>
                        <td><?php echo e($instalacion->serial_fuente); ?></td>
                        <td colspan="4">
                            <?php echo e($instalacion->rack->area->sala->sala); ?> 
                            <?php echo e($instalacion->rack->area->area); ?> 
                            <?php echo e($instalacion->rack->rack); ?> 
                            <?php echo e($instalacion->posicion); ?>

                        </td>
                        <td><?php echo e($instalacion->installer->username); ?></td>
                        <td><?php echo e($instalacion->created_at); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
			<?php endif; ?>
		</div>
	</body>
</html>
<?php
$html=ob_get_contents();
ob_end_clean();
$mipdf->load_html($html,'UTF-8');
$mipdf->render();
$canvas = $mipdf->get_canvas(); 
$canvas->page_text(525,16,"Pág. {PAGE_NUM}/{PAGE_COUNT}",'times',6,array(0,0,0));
$canvas->page_text(235,792,"Copyright © 2018 - CoinCoin - www.coincoin.com.ve",'times', 6, array(0,0,0));
$mipdf->stream('Instalaciones_Generales.pdf');

