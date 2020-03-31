<!DOCTYPE html>
<html>
	<head>
		<title>Print Bill</title>
		<style type="text/css">
			.h2{ font-weight: 600; font-size: 30px; }
			.h3{ font-weight: 600; font-size: 25px; }
			.h4{ font-weight: 600; font-size: 15px; }
			.rounded{
				background-color: red;
				border: 1px solid #000;
			}
		</style>
	</head>
	<body>
		<table width="50%">
			<tr align="center"><td><span class="h2">SRIRAMPUR HOSPITAL</span></td></tr>
			<tr align="center"><td><span class="h4">WEST BENGAL</span></td></tr>
			<tr align="center"><td><span class="h3">Provisional Bill</span></td></tr>
		</table>
		<table width="50%">
			<tr>
				<td><strong>Bill No.</strong></td>
				<td>123456</td>
				<td><strong>Payment Data</strong></td>
				<td>17-May-2019</td>
			</tr>
			<tr>
				<td><strong>Name</strong></td>
				<td colspan="3">Patient Name</td>
			</tr>
			<tr>
				<td>Doctor</td>
				<td colspan="3">Doctor Name</td>
			</tr>
			<tr>
				<td><strong>Patient ID</strong></td>
				<td>P20190515001</td>
				<td><strong>Stay</strong></td>
				<td>10 Day</td>
			</tr>
			<tr>
				<td><strong>Admission ID</strong></td>
				<td>AD20190515002</td>
				<td><strong>Admission Date</strong></td>
				<td>17-May-2019</td>
			</tr>
			<tr>
				<td><strong>Department</strong></td>
				<td>Critical Care</td>
				<td><strong>Ward</strong></td>
				<td>ICCU</td>
			</tr>
			<tr>
				<td><strong>Bed</strong></td>
				<td colspan="3">ICCU01</td>
			</tr>
		</table>
		<table width="50%" border="1" cellpadding="0" cellspacing="0">
			<tr>
				<th>Particular</th>
				<th>Amount</th>
				<th>Qty</th>
				<th>UOM</th>
				<th>Total Amt.</th>
			</tr>
			<tr>
				<td>Bed Charge</td>
				<td align="right">2600.00</td>
				<td align="right">1</td>
				<td align="right">1</td>
				<td align="right">2600.00</td>
			</tr>
		</table>
		<table width="50%">
			<tr>
				<td></td>
				<td width="60%">
					<table width="100%">
						<tr>
							<td><strong>Total Amount</strong></td>
							<td>:</td>
							<td align="right">2600.00</td>
						</tr>
						<tr>
							<td><strong>Service Charge @ 15%</strong></td>
							<td>:</td>
							<td align="right">0.00</td>
						</tr>
						<tr>
							<td><strong>Net Amount</strong></td>
							<td>:</td>
							<td align="right">2600.00</td>
						</tr>
						<tr class="rounded">
							<td><strong>Rounded Net</strong></td>
							<td>:</td>
							<td align="right">2600</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>