<div class="card">
    <div class="row">
        <div class="card-body">
			<table width="100%">
				<tr>
					<td>
						<table width="100%">
							<tr align="center">
								<td style="width: 20%;"><img src="<?=base_url('assets/img/nbm-logo.png')?>"></td>
								<td style="width: 60%;">
										<h2 class="font-weight-bold">DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</h2>
										<h4 class="font-weight-bold">Managed by New Barrackpore Municipality<br>033-25375393<br>Money Receipt</h4>
								</td>
								<td style="width: 20%;"><img src="<?=base_url('assets/img/h-logo.png')?>" width="90px"></td>
							</tr>
						</table>
						<hr>
					</td>
				</tr>
				<tr style="font-size: 15px;">
					<td>
						<table width="100%" cellpadding="0" cellspacing="3">
							<tr>
								<td><strong>Ticket No.</strong></td>
								<td>: <?=str_replace('-', '', $tData->app_date).'/'.$tData->app_que?></td>
								<td><strong>Receipt No.</strong></td>
								<td>: <?='OP'.sprintf('%04d', $this->uri->segment(3))?></td>
							</tr>
							<tr>
								<td><strong>Name</strong></td>
								<td>: <?=$tData->name?></td>
								<td><strong>Date & Time</strong></td>
								<td>: <?=date('d-M-y', strtotime($tData->app_date))?> <?=date('h:i A', strtotime($tData->app_time))?></td>
							</tr>
							<tr>
								<td><strong>Age &  Sex</strong></td>
								<td>: <?=$tData->age.' '.$tData->age2.'/'.$tData->gender?></td>
								<td><strong>Referred By</strong></td>
								<td>: 
									<?php
										if (is_numeric($tData->referredby))
											echo $this->my_library->GetParam('h_doctor', 'name', array('doctor_id' => $tData->referredby));
										else echo $tData->referredby;
									?>
								</td>
							</tr>
							<tr>
								<td><strong>Collected By</strong></td>
								<td>: <?php
									if ($tData->collectedby)
										echo $this->my_library->GetParam('users', 'name', array('id' => $tData->collectedby));
									else echo "Admin";
								?></td>
								<td></td><td></td>
							</tr>
						</table>
						<hr>
					</td>
				</tr>
				<tr style="font-size: 15px;">
					<td>
						<table width="100%" border="1" cellpadding="2" cellspacing="0">
							<tr style="background-color: #e0e0e0;">
								<th><strong>Group</strong></th>
								<th><strong>Particular</strong></th>
								<th><strong>Category</strong></th>
								<th><strong>Amount</strong></th>
							</tr>
							<?php $Total = 0;
								$category   = explode(',', $tData->category);
								$particular = explode(',', $tData->particular);
								$amount     = explode(',', $tData->amount);
								for ($i = 0; $i < count($category); $i++) { 
									echo'
										<tr>
											<td>'.$this->my_library->GetParam('outdoor_facility_group', 'group_name', array('g_code' => $category[$i])).'</td>
											<td>'.$this->my_library->GetParam('outdoor_facility', 'facilit_name', array('od_facilit_id' => $particular[$i])).'</td>
											<td>'.$tData->patient_type.'</td>
											<td>'.number_format((float)$amount[$i], 2, '.', '').'</td>
										</tr>
									';$Total += $amount[$i];
								}
							?>
							<tr>
								<td></td><td><strong>Total Amount</strong></td>
								<td></td><td class="font-weight-bold"><?=number_format((float)$Total, 2, '.', '')?></td>
							</tr>
							<?php
								if ($tData->distype == 'Refund') {
									echo'
										<tr>
											<td></td><td><strong>Refund Amount</strong></td>
											<td></td><td>'.number_format((float)$tData->disval, 2, '.', '').'</td>
										</tr>
										<tr>
											<td></td><td><strong>Net Amount</strong></td>
											<td></td><td class="font-weight-bold">'.number_format((float)$tData->after_discount, 2, '.', '').'</td>
										</tr>
									';
								} elseif ($tData->distype == 'Amount') {
									echo'
										<tr>
											<td></td><td><strong>Discount Amount </strong><i>(Order by Chairman)</i></td>
											<td></td><td>'.number_format((float)$tData->disval, 2, '.', '').'</td>
										</tr>
										<tr>
											<td></td><td><strong>Net Amount</strong></td>
											<td></td><td class="font-weight-bold">'.number_format((float)$tData->after_discount, 2, '.', '').'</td>
										</tr>
									';
								} elseif ($tData->distype == 'Percentage') {
									echo'
										<tr>
											<td></td><td><strong>Discount Percentage ['.$tData->disval.'%] </strong><i>(Order by Chairman)</i></td>
											<td></td><td>'.number_format((float)($Total - $tData->after_discount), 2, '.', '').'</td>
										</tr>
										<tr>
											<td></td><td><strong>Net Amount</strong></td>
											<td></td><td class="font-weight-bold">'.number_format((float)$tData->after_discount, 2, '.', '').'</td>
										</tr>
									';
								}
							?>
						</table>
					</td>
				</tr>
				<tr style="font-size: 15px;">
					<td style="padding-top: 50px;">
						<table width="100%">
							<tr>
								<td style="width: 50%;">
									<table width="100%">
										<tr align="center"><td>
											<img src="<?=base_url('assets/img/chair-person.png')?>" width="130px">
											<br>----------------------------------------------<br>
											Chairperson
										</td></tr>
										<tr align="center"><td>New Barrackpore Municipality</td></tr>
									</table>	
								</td>
								<td style="width: 50%;">
									<table width="100%">
										<tr align="center"><td>
											<img src="<?=base_url('assets/img/chair-man.png')?>">
											<br>----------------------------------------------<br>
											Chairman
										</td></tr>
										<tr align="center"><td>Managing Committee DR. B. C. ROY GENERAL HOSPITAL & MATERNITY HOME</td></tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
    	</div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-primary" id="PrintBill">Print <i class="fas fa-print"></i></button>
		<a href="<?=base_url('outdoor/update/'.$this->uri->segment(3))?>" class="btn btn-info" id="UpdateParticular">
			Update Particular
		</a>
	</div>
</div>