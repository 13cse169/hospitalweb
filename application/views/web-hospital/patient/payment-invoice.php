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
									<h4>Managed by New Barrackpore Municipality<br>033-25375393<br><u>Money Receipt</u></h4>
							</td>
							<td style="width: 20%;"><img src="<?=base_url('assets/img/h-logo.png')?>" width="90px"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td><h1><hr></h1></td></tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td style="width: 60%;">
								<table width="100%">
									<tr>
										<?php if(isset($pay_type)) { ?>
											<td style="width: 30%;"><strong>Advance Pay ID</strong> </td>
											<td style="width: 70%;">: <?=$pay_type?></td>
										<?php } else { ?><td></td><td></td><?php } ?>
									</tr>
								</table>	
							</td>
							<td  style="width: 40%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Date/Time</strong> </td>
										<td style="width: 70%;">: <?=date('d-M-y h:i:s')?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td style="width: 60%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Patient ID</strong> </td>
										<td style="width: 70%;">: <?=$patient_id?></td>
									</tr>
								</table>	
							</td>
							<td  style="width: 40%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Reg. Date</strong> </td>
										<td style="width: 70%;">: <?=$regDate?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td style="width: 60%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Name</strong> </td>
										<td style="width: 70%;">: <?=$patient_name?></td>
									</tr>
								</table>	
							</td>
							<td  style="width: 40%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Age & Sex</strong> </td>
										<td style="width: 70%;">: <?=$age?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td style="width: 60%;">
								<table width="100%">
									<tr>
										<td style="width: 30%;"><strong>Referred By</strong> </td>
										<td style="width: 70%;">: <?=$doctor?></td>
									</tr>
								</table>	
							</td>
							<td  style="width: 40%;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td><h1><hr></h1></td></tr>
			<tr><td><h1>&nbsp;</h1></td></tr>
			<tr>
				<td>
					<table width="100%">
						<tr>
							<td align="center"><strong>Date</strong></td>
							<td align="center"><strong>Payment Mode</strong></td>
							<td align="center"><strong>Received By</strong></td>
							<td align="center"><strong>Purpose</strong></td>
							<td align="center"><strong>Amount</strong></td>
						</tr>
						<?=$paidInfo?>
					</table>
				</td>
			</tr>
			<tr><td><h1>&nbsp;</h1></td></tr>
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
										Chairman Managing Committee
									</td></tr>
									<tr><td>DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</td></tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>