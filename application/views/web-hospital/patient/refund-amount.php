<div class="page-header">
	<h4 class="page-title">HOSPITAL MASTER</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Refund Amount</a></li>
	</ol>
</div>

<div class="card">
    <div class="row">
        <div class="card-body">
            <div class="col-12">
                <div class="table-responsive">
                    <h4 class="m-t-0 header-title"><strong>Patient List</strong></h4>
                    <table id="datatables2" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%"
                        data-table="sales_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Total Amt.</th>
                                <td align="center" colspan="3"><strong>Paid/Discount Amtount</strong></td>
                                <th>Refund Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td><td></td><td></td><td></td><td align="right"><strong>Paid</strong></td>
                                <td align="right"><strong>Discount</strong></td><td align="right"><strong>Total</strong></td><td></td>
                            </tr>
                            <?php $count = 0; foreach ($Patient as $key => $value) { 
                                $tID = $this->my_library->GetParam('h_treatment', 'treatment_id', array('patient_id' => $value->patient_id)); ?>
                                <tr id="<?=$value->patient_id?>">
                                    <td><?=++$count?></td>
                                    <td><?=$value->code?></td>
                                    <td><?=$value->name?></td>
                                    <td align="right"><?php
                                        $TotalAmt = $this->my_library->GetAmount($value->patient_id);
                                        echo number_format((float)$TotalAmt, 2, '.', '');
                                    ?></td>
                                    <td align="right"><?php
                                        $PaidAmt = $this->M_Hospital->GetSum('h_payment', 'pay_amt', array('treatment_id' => $tID));
                                        echo number_format((float)$PaidAmt, 2, '.', '');
                                    ?></td>
                                    <td align="right"><?php
                                        $Type = $this->my_library->GetParam('h_treatment', 'discount_typ', array('patient_id' => $value->patient_id));
                                        $Discount = $this->my_library->GetParam('h_treatment', 'discount', array('patient_id' => $value->patient_id));
                                        if ($Type == 'Percentage') $Discount = (($TotalAmt * $Discount) / 100);
                                        echo number_format((float)$Discount, 2, '.', '');
                                    ?></td>
                                    <td align="right"><?=number_format((float)($PaidAmt + $Discount), 2, '.', '')?></td>
                                    <td align="center">
                                        <?php if ($value->refund_amt > 0) {
                                                echo number_format((float)$value->refund_amt, 2, '.', '');
                                            } else { ?>
                                               <a href="#" class="btn btn-success btn-sm RefundAmt" data-toggle="modal" data-target="#myModal">
                                                   <i class="fas fa-rupee-sign"></i>
                                               </a> 
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>                
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-primary">Refund Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Amt.</label>
                                <input type="number" class="form-control TotalAmt" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Paid Amt.</label>
                                <input type="number" class="form-control PaidAmt" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Discount Amt.</label>
                                <input type="number" class="form-control DiscountAmt" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Total Paid Amt.</label>
                                <input type="number" class="form-control TotalPaidAmt" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Due Amt.</label>
                                <input type="number" class="form-control DueAmt" readonly="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Refund Amt.</label>
                                <input type="number" class="form-control required" name="refund_amt">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Enter Description</label>
                                <textarea class="form-control" name="refund_dis"></textarea>
                            </div>
                        </div>
                        <input type="hidden" class="PatientID" name="id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Refund Amount</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </form>    
        </div>
    </div>
</div>
