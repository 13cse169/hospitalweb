<!DOCTYPE html>
<html>
	<head>
		<title>Money Receipt</title>
	</head>
	<body>
		<table width="100%">
			<tr>
				<td>
					<table width="100%">
						<tr align="center">
							<td style="width: 20%;"><img src="<?=base_url('assets/img/nbm-logo.png')?>"></td>
							<td style="width: 60%;">
								<h2>DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</h2>
								<h4>Managed by New Barrackpore Municipality<br>033-25375393<br><?=$billType?></h4>
							</td>
							<td style="width: 20%;"><img src="<?=base_url('assets/img/h-logo.png')?>" width="90px"></td>
						</tr>
					</table>
					<hr>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="0" cellspacing="3">
						<tr>
							<td><strong>Patient ID</strong></td><td>: <?=$pCode?></td>
							<td><strong>Bill Date</strong></td><td>: <?=date('d-M-y H:i:s')?></td>
						</tr>
						<tr><td><strong>Name</strong></td><td colspan="3">: <?=$pName?></td></tr>
						<tr><td><strong>Doctor</strong></td><td colspan="3">: <?=$dName?></td></tr>
						<tr>
							<td><strong>Admission ID</strong></td><td>: <?=$pAID?></td>
							<td><strong>Admission Date</strong></td><td>: <?=$aDate?></td>
						</tr>
					</table>
					<hr>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="1" cellpadding="2" cellspacing="0">
						<tr style="background-color: #e0e0e0;">
							<th style="width: 80%;"><strong>Facility Charges</strong></th>
							<th style="width: 20%;"><strong>Amount</strong></th>
						</tr>
						<?=$Data?>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" cellpadding="2" cellspacing="0">
						<tr>
							<td align="right" style="width: 80%"><strong>Total Bill :</strong></td>
							<td align="right" style="width: 20%;"><?=$total?></td>
						</tr>
						<tr>
							<td align="right" style="width: 80%">
								<strong>Advance payment </strong><?=($AdvPay)?$AdvID:''?><strong> :</strong>
							</td>
							<td align="right" style="width: 20%;"><?=$AdvPay?></td>
						</tr>
						<?php if($disAmt > 0) { ?>
							<tr>
								<td align="right" style="width: 80%">
									<strong>Less (Discount  by Chairman with request on patient party.) :</strong>
								</td>
								<td align="right" style="width: 20%;"><?=$disAmt?></td>
							</tr>
						<?php } ?>
						<tr>
							<td align="right" style="width: 80%"><strong>Final payment :</strong></td>
							<td align="right" style="width: 20%;">
								<?php $Finalpayment = ($paidAmt - $AdvPay); echo number_format((float)$Finalpayment, 2, '.', ''); ?>
							</td>
						</tr>
						<?php if(isset($Refund)) { ?>
							<tr>
								<td align="right" style="width: 80%"><strong>Refund Amount :</strong></td>
								<td align="right" style="width: 20%;">
									<?=$Refund?>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td align="right" style="width: 80%"><strong>Balance Bill :</strong></td>
							<td align="right" style="width: 20%;">
								<?php
									$BalanceBill = (isset($Refund)) ? ($total - $paidAmt - $disAmt + $Refund) : ($total - $paidAmt - $disAmt);
									if ($BalanceBill > 0) echo number_format((float)$BalanceBill, 2, '.', ''); else echo '0.00'
								?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table width="100%">
						<tr>
							<td>
								<table width="100%">
									<tr><td>
										<img src="<?=base_url('assets/img/chair-person.png')?>" width="130px">
										<br>----------------------------------------------<br>
										Chairperson
									</td></tr>
									<tr><td>New Barrackpore Municipality</td></tr>
								</table>	
							</td>
							<td>
								<table width="100%">
									<tr><td>
										<img src="<?=base_url('assets/img/chair-man.png')?>">
										<br>----------------------------------------------<br>
										Chairman
									</td></tr>
									<tr><td>Managing Committee DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>