<div class="admin-navbar" id="headerMenuCollapse">
	<div class="container">
		<ul class="nav">
			
			<li class="nav-item">
				<a class="nav-link <?=($active == 'Dashboard')?'active':''?>" href="<?=base_url('dashboard')?>"><i class="fa fa-home"></i><span> DASHBOARD</span></a>
			</li>

			<li class="nav-item with-sub">
				<a class="nav-link <?=($active == 'Master')?'active':''?>" href="#"><i class="fas fa-clinic-medical"></i> <span>Hospital Master</span></a>
				<div class="sub-item">
					<ul>
						<li>
							<a href="<?=base_url('master/doctor')?>">Doctor Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('master/department')?>">Department Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('master/ward')?>">Ward Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('master/bed')?>">Bed Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('master/attendentshift')?>">Attendent Shift Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('master/attendent')?>">Attendent Master</a>
							<div class="dropdown-divider"></div>
						</li>
						<!-- <li>
							<a href="<?=base_url('master/facility')?>">Facility Charge</a>
						</li> -->
						<li class="sub-with-sub">
							<a href="#">Facility Charge</a><div class="dropdown-divider"></div>
							<ul>
								<li>
									<a href="<?=base_url('master/facility-category')?>">Add Category</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('master/facility-add')?>">Add Facility</a>
									<div class="dropdown-divider"></div>
								</li>
							</ul>
						</li>
						<li>
							<a href="<?=base_url('user')?>">User Master</a>
							<!-- <div class="dropdown-divider"></div> -->
						</li>
					</ul>
				</div>
			</li>

			<!-- <li class="nav-item">
				<a class="nav-link <?=($active == 'Patient')?'active':''?>" href="<?=base_url('patient/all')?>"><i class="fas fa-procedures"></i><span> Patient</span></a>
			</li> -->

			<li class="nav-item with-sub">
				<a class="nav-link <?=($active == 'Patient')?'active':''?>" href="#"><i class="fas fa-procedures"></i> <span>Patient</span></a>
				<div class="sub-item">
					<ul>
						<li>
							<a href="<?=base_url('patient/all')?>">Indoor Patient Treat.</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('outdoor')?>">Outdoor Patient Treat.</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('patient/emergency')?>">Emergency Treat.</a>
							<div class="dropdown-divider"></div>
						</li>
						<!-- <li>
							<a href="<?=base_url('patient/refund-amount')?>">Refund Amount</a>
							<div class="dropdown-divider"></div>
						</li> -->
						<li class="sub-with-sub">
							<a href="#">Patient List</a>
							<ul>
								<li>
									<a href="<?=base_url('patient/list')?>">Patient Treatment List</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('patient/discharge-list')?>">Patient Discharge List</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</li>
			
			<li class="nav-item with-sub">
				<a class="nav-link" href="#"><i class="fas fa-search"></i> <span>Search Option</span></a>
				<div class="sub-item">
					<ul>
						<li>
							<a href="#">Doctor Search</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Patient Search</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Outdoor Patient Search</a>
						</li>
					</ul>
				</div>
			</li>

			<li class="nav-item with-sub">
				<a class="nav-link <?=($active == 'Report')?'active':''?>" href="<?=base_url('patient/all')?>" href="#">
					<i class="fas fa-receipt"></i> <span>Report</span>
				</a>
				<div class="sub-item">
					<ul>
						<li>
							<a href="<?=base_url('report/indoor')?>">Indoor Report</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('report/operativesurgeon')?>">Indoor Doctor Report</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('report/outdoor')?>">Outdoor Report</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="<?=base_url('report/emergency')?>">Emergency Report</a>
							<!-- <div class="dropdown-divider"></div> -->
						</li>
					</ul>
				</div>
			</li>

			<li class="nav-item with-sub">
				<a class="nav-link <?=($active == 'Pathology')?'active':''?>" href="#"><i class="fas fa-bible"></i> <span>Pathology</span></a>
				<div class="sub-item">
					<ul>
						<li class="sub-with-sub">
							<a href="#">Pathology Master</a><div class="dropdown-divider"></div>
							<ul>
								<li>
									<a href="<?=base_url('pathology/master/department-test')?>">Department For Test</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/master/test-head')?>">Test Head</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/master/add-test')?>">Add Test</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/master/doctor-comission')?>">Referred Doctor Comm.</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/master/agent-collection-list')?>">Collection Agent</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/master/agent-comission')?>">Collection Agent Comm.</a>
								</li>
							</ul>
						</li>
						<li class="sub-with-sub">
							<a href="#">Pathology Entry</a><div class="dropdown-divider"></div>
							<ul>
								<li>
									<a href="<?=base_url('pathology/entry/booking')?>">Booking Entry</a>
									<div class="dropdown-divider"></div>
								</li>
								<!-- <li>
									<a href="#">Booking Modification</a>
									<div class="dropdown-divider"></div>
								</li> -->
								<li>
									<a href="<?=base_url('pathology/entry/due-payment')?>">Due Payment</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="<?=base_url('pathology/entry/search-report')?>">Search Test Reports</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Test Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Interface</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">ECG Report Entry</a>
								</li>
							</ul>
						</li>
						<li class="sub-with-sub">
							<a href="#">Pathology Print</a><div class="dropdown-divider"></div>
							<ul>
								<li>
									<a href="#">Report Print</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Report Print (Test Wise)</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Report Print (Dept. Wise)</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Report Print (ECG Report)</a>
								</li>
							</ul>
						</li>
						<li class="sub-with-sub">
							<a href="#">Pathology Report</a>
							<ul>
								<li>
									<a href="#">Test Wise Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Daily Collection Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Due Payment Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Patient Test Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Doctor Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Collection Agent Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Dr. Wise Collection Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Dr. Commission Percentage</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Doctor Commission Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Coll. Agent Comm. % Report</a>
									<div class="dropdown-divider"></div>
								</li>
								<li>
									<a href="#">Coll. Agent Comm. Report</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</li>

			<li class="nav-item with-sub">
				<a class="nav-link" href="#"><i class="fas fa-print"></i> <span>Print Option</span></a>
				<div class="sub-item">
					<ul>
						<li>
							<a href="#">Registration Slip</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Outdoor Patient Bill</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Indoor Patient Receipt</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Discharge Certificate</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Indoor Patient History</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Indoor Patient Barcode</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Patient Ledger Statem.</a>
							<div class="dropdown-divider"></div>
						</li>
						<li>
							<a href="#">Indoor Patient Case</a>
						</li>
					</ul>
				</div>
			</li>

		</ul>
	</div>
</div>
