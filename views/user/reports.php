 <style>
.vl {
 border-left: 2px solid green;
    height: 51px;
}

</style>
<?php 
    $total_payment = 0;
    $emiac = 0;
    $eminence = 0;
    $paypal = 0;
    $other = 0;
    $content_sales = 0;
    $link_sales = 0;
    $pending_content_sales = 0;
    $pending_link_sales = 0;
    $vendor_payment = 0;
    $vendor_paypal = 0;
    $vendor_eminence = 0;
    $vendor_other = 0;
    $link_payment_not_received = 0;
    $content_payment_not_received = 0;
    $cancel_payment = 0;
    $cancel_order = 0;
    $pending_order = 0;
    $pending_payment = 0;
    $vendor_payment_rem = 0;
    $total_vendor = 0;
    $minus_payment = 0;
    $minus_vendor_payment = 0;
    $number_vendors = 0;
    $link_payment = 0;
    $given_content_sales = 0;
    $given_link_sales = 0;
    foreach($orders as $key => $order_value){
        if($order_value['client_amount_received_status'] == 'Received'){
            $total_payment = $total_payment + $order_value['client_amount_received'];
        }
        if($order_value['client_account_type'] == 'Eminence'){
            $eminence = $eminence + $order_value['client_amount_received'];
        }elseif($order_value['client_account_type'] == 'Paypal'){
            $paypal = $paypal + $order_value['client_amount_received'];
        }
        elseif($order_value['client_account_type'] == 'Emiac'){
            $emiac = $emiac + $order_value['client_amount_received'];
        }
        elseif($order_value['client_account_type'] == 'Other'){
            $other = $other + $order_value['client_amount_received'];
        }
        if($order_value['vendor_account_type'] == 'Paypal'){
            $vendor_paypal = $vendor_paypal + $order_value['vendor_payment_amount'];
        }
        if($order_value['vendor_account_type'] == 'Eminence'){
            $vendor_eminence = $vendor_eminence + $order_value['vendor_payment_amount'];
        }
        if($order_value['vendor_account_type'] == 'Other'){
            $vendor_other = $vendor_other + $order_value['vendor_payment_amount'];
        }
        if($order_value['vendor_payment_status'] == 'Paid'){
            $vendor_payment = $vendor_payment + $order_value['vendor_payment_amount'];
        }
        
        if($order_value['client_amount_received_status'] == 'Not_Received' && $order_value['status']!= 'Not_Publish' && $order_value['status']!= 'Cancel'){
            $link_payment_not_received = $link_payment_not_received + $order_value['proposed_amount'];
            $content_payment_not_received = $content_payment_not_received + $order_value['content_amount'];
        }
        if($order_value['client_amount_received_status'] == 'Not_Received' && $order_value['status'] == 'Cancel'){
            $cancel_order++;
            $cancel_payment = $cancel_payment + ($order_value['proposed_amount']+$order_value['content_amount']);
        }
        
        if($order_value['status'] == 'Cancel' || $order_value['status'] == 'Not_Publish'){
            $minus_payment = $minus_payment + ($order_value['proposed_amount']+$order_value['content_amount']);
            $minus_vendor_payment = $minus_vendor_payment + $order_value['site_cost'];
            
        }
        if($order_value['status'] == 'Given'){
            $pending_order++;
            $pending_payment = $pending_payment + ($order_value['proposed_amount']+$order_value['content_amount']);
        }
         $content_sales = $content_sales+$order_value['content_amount'];
         $link_sales = $link_sales + $order_value['proposed_amount'];
         $link_payment = $link_payment + $order_value['site_cost'];  
         $number_vendors++;
        if($order_value['status'] == 'Publish' && $order_value['vendor_payment_status'] != 'Paid'){
            $vendor_payment_rem = $vendor_payment_rem+$order_value['site_cost'];
            $total_vendor++;
        }
        if($order_value['status'] == 'Pending'){
            $pending_content_sales = $pending_content_sales+$order_value['content_amount'];
            $pending_link_sales = $pending_link_sales+$order_value['proposed_amount'];
        }
        
        if($order_value['status'] == 'Given'){
            $given_content_sales = $given_content_sales+$order_value['content_amount'];
            $given_link_sales = $given_link_sales+$order_value['proposed_amount'];
        }
        
    }  
?>
<form class="form-horizontal" action="<?php echo base_url('reports'); ?>" method="post">
<div class="row mt-2 mb-1">
    
    <div class="col-md-2">
       
        <input type="text" name="start_date" class="form-control datepicker" id=""  placeholder="From Date" value="<?php if(!empty($start_date))echo $start_date;?>">
    </div>
    <div class="col-md-2">
        
        <input type="text" name="end_date" class="form-control datepicker" id=""  placeholder="To Date" value="<?php if(!empty($end_date))echo $end_date;?>">
    </div>
    <div class="col-md-2">
        <select name="year" class="js-example-basic-single-one form-control">
            <option value="">Select Year</option>
            <option value="2018" <?php if(!empty($year) && $year == 2018) echo 'selected'; ?>>2018</option>
            <option value="2019" <?php if(!empty($year) && $year == 2019) echo 'selected'; ?>>2019</option>
            <option value="2020" <?php if(!empty($year) && $year == 2020) echo 'selected'; ?>>2020</option>
            <option value="2021" <?php if(!empty($year) && $year == 2021) echo 'selected'; ?>>2021</option>
            <option value="2022" <?php if(!empty($year) && $year == 2022) echo 'selected'; ?>>2022</option>
            <option value="2023" <?php if(!empty($year) && $year == 2023) echo 'selected'; ?>>2023</option>
            <option value="2024" <?php if(!empty($year) && $year == 2024) echo 'selected'; ?>>2024</option>
            <option value="2025" <?php if(!empty($year) && $year == 2025) echo 'selected'; ?>>2025</option>
            <option value="2026" <?php if(!empty($year) && $year == 2026) echo 'selected'; ?>>2026</option>
            <option value="2027" <?php if(!empty($year) && $year == 2027) echo 'selected'; ?>>2027</option>
            <option value="2028" <?php if(!empty($year) && $year == 2028) echo 'selected'; ?>>2028</option>
            <option value="2029" <?php if(!empty($year) && $year == 2029) echo 'selected'; ?>>2029</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="month" class="js-example-basic-single-one form-control">
            <option value="">Select Month</option>
            <option value="01" <?php if(!empty($month) && $month == 01) echo 'selected'; ?>>January</option>
            <option value="02" <?php if(!empty($month) && $month == 02) echo 'selected'; ?>>February</option>
            <option value="03" <?php if(!empty($month) && $month == 03) echo 'selected'; ?>>March</option>
            <option value="04" <?php if(!empty($month) && $month == 04) echo 'selected'; ?>>April</option>
            <option value="05" <?php if(!empty($month) && $month == 05) echo 'selected'; ?>>May</option>
            <option value="06" <?php if(!empty($month) && $month == 06) echo 'selected'; ?>>Jun</option>
            <option value="07" <?php if(!empty($month) && $month == 07) echo 'selected'; ?>>July</option>
            <option value="08" <?php if(!empty($month) && $month == 8) echo 'selected'; ?>>August</option>
            <option value="09" <?php if(!empty($month) && $month == 9) echo 'selected'; ?>>September</option>
            <option value="10" <?php if(!empty($month) && $month == 10) echo 'selected'; ?>>October</option>
            <option value="11" <?php if(!empty($month) && $month == 11) echo 'selected'; ?>>Novenmber</option>
            <option value="12" <?php if(!empty($month) && $month == 12) echo 'selected'; ?>>December</option>
        </select>
    </div>
	 <div class="col-md-2">
        <select name="period" class="js-example-basic-single-one form-control" id="period">
            <option value="">Select</option>
            <option value="3" <?php if(!empty($period) && $period == 3) echo 'selected'; ?>>3</option>
            <option value="6" <?php if(!empty($period) && $period == 6) echo 'selected'; ?>>6</option>
            <option value="9" <?php if(!empty($period) && $period == 9) echo 'selected'; ?>>9</option>
            <option value="12" <?php if(!empty($period) && $period == 12) echo 'selected'; ?>>12</option>
        </select>
    </div>
    <div class="col-md-1">
        <div class="text-center">
            <button type="submit" class="btn btn-secondary form-control">Filter</button>
        </div>
    </div>
</div>

</form>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h6 style="text-align: center;">TOTAL SALES</h6>
                 <a href="<?php if(!empty($month)){ echo base_url('reports_list/ts/'.$month); }elseif(!empty($start_date)){ echo base_url('reports_list/pr/01/'.$start_date.'/'.$end_date); } ?>" class="btn btn-info btn-lg active" role="button" aria-pressed="true">View All</a>
                    <hr>
                <div class="d-flex">
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       <label>Content Sales</label>
                       <p><?php echo '$'.$content_sales; ?></p>
                    </div>
                    <div class="col-4 align-self-center text-center vl">
                            <label>Link Sales</label>
                            <p><?php echo '$'.$link_sales; ?></p>                                                          
                    </div>
                    <div class="col-4 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php $total_sal = ($link_sales+$content_sales-($minus_payment));echo '$'.($total_sal); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h6 style="text-align: center;">PAYMENT RECEIVED</h6>
                 <a href="<?php if(!empty($month)){ echo base_url('reports_list/pr/'.$month);}elseif(!empty($start_date)){ echo base_url('reports_list/pr/01/'.$start_date.'/'.$end_date); } ?>" class="btn btn-info btn-lg active" role="button" aria-pressed="true">View All</a>
                    <hr>
                <div class="d-flex">
                    <div class="col-3 align-self-center bgimageset text-center vl">
                       <label>Eminence</label>
                       <p><?php echo '$'.$eminence; ?></p>
                    </div>
                    <div class="col-2 align-self-center bgimageset text-center vl">
                       <label>Paypal</label>
                       <p><?php echo '$'.$paypal; ?></p>
                    </div>
                    <div class="col-3 align-self-center bgimageset text-center vl">
                       <label>Emiac</label>
                       <p><?php echo '$'.$emiac; ?></p>
                    </div>
                    <div class="col-2 align-self-center text-center vl">
                            <label>Other</label>
                            <p><?php echo '$'.$other; ?></p>                                                        
                    </div>
                    <div class="col-2 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php echo '$'.$total_payment; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">PAYMENT NOT RECEIVED</h5>
                     <a href="<?php if(!empty($month)){ echo base_url('reports_list/pn/'.$month);}elseif(!empty($start_date)){ echo base_url('reports_list/pn/01/'.$start_date.'/'.$end_date); } ?>" class="btn btn-info btn-lg active" role="button" aria-pressed="true">View All</a>
                    <hr>
                <div class="d-flex">
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       <label>Content Payment</label>
                       <p><?php echo '$'.$content_payment_not_received; ?></p>
                    </div>
                    <div class="col-4 align-self-center text-center vl">
                            <label>Link Payment</label>
                            <p><?php echo '$'.$link_payment_not_received; ?></p>                                                          
                    </div>
                    <div class="col-4 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php echo '$'.($total_sal-$total_payment); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">TOTAL VENDOR PAYMENT</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-6 align-self-center bgimageset text-center vl">
                       <label>Total Vendor</label>
                       <p><?php echo $number_vendors; ?></p>
                    </div>
                    <div class="col-6 align-self-end align-self-center text-center vl">
                        <label>Total Amount</label>
                         <p><?php echo '$'.($link_payment-$minus_vendor_payment); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">VENDOR PAYMENT DONE</h5>
                     <a href="<?php if(!empty($month)){ echo base_url('reports_list/vp/'.$month);}elseif(!empty($start_date)){ echo base_url('reports_list/vp/01/'.$start_date.'/'.$end_date); } ?>" class="btn btn-info btn-lg active" role="button" aria-pressed="true">View All</a>

                    <hr>
                <div class="d-flex">
                    <div class="col-3 align-self-center bgimageset text-center vl">
                       <label>Eminence</label>
                       <p><?php echo '$'.$vendor_eminence; ?></p>
                    </div>
                    <div class="col-3 align-self-center bgimageset text-center vl">
                       <label>Paypal</label>
                       <p><?php echo '$'.$vendor_paypal; ?></p>
                    </div>
                    <div class="col-3 align-self-center text-center vl">
                            <label>Other</label>
                            <p><?php echo '$'.$vendor_other; ?></p>                                                        
                    </div>
                    <div class="col-3 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php echo '$'.$vendor_payment; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">VENDOR PAYMENT REMAINING</h5>
                     <a href="<?php if(!empty($month)){ echo base_url('reports_list/vpn/'.$month);}elseif(!empty($start_date)){ echo base_url('reports_list/vpn/01/'.$start_date.'/'.$end_date); } ?>" class="btn btn-info btn-lg active" role="button" aria-pressed="true">View All</a>
                    <hr>
                <div class="d-flex">
                    <div class="col-6 align-self-center bgimageset text-center vl">
                       <label>Total Vendor</label>
                       <p><?php echo $total_vendor; ?></p>
                    </div>
                    <div class="col-6 align-self-end align-self-center text-center vl">
                        <label>Total Amount</label>
                         <p><?php echo '$'.($link_payment-$vendor_payment); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">PROFIT MARGIN</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       <label>Total Client receivable Amount</label>
                       <p><?php echo '$'.($total_payment+($link_payment_not_received+$content_payment_not_received)); ?></p>
                    </div>
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       
                       <label>Total Vendor Payble Amount</label>
                       <p><?php echo '$'.($link_payment); ?></p>
                    </div>
                    <div class="col-4 align-self-end align-self-center text-center vl">
                        <label>Total Margin</label>
                         <p><?php echo '$'.(($total_payment+($link_payment_not_received+$content_payment_not_received))-($link_payment)); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">PENDING ORDER</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       <label>Content Sales</label>
                       <p><?php echo '$'.$pending_content_sales; ?></p>
                    </div>
                    <div class="col-4 align-self-center text-center vl">
                            <label>Link Sales</label>
                            <p><?php echo '$'.$pending_link_sales; ?></p>                                                          
                    </div>
                    <div class="col-4 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php echo '$'.($pending_link_sales+$pending_content_sales); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">CANCEL ORDER</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-6 align-self-center bgimageset text-center vl">
                       <label>Total Canceled Order</label>
                       <p><?php echo $cancel_order; ?></p>
                    </div>
                    <div class="col-6 align-self-end align-self-center text-center vl">
                        <label>Total Amount</label>
                         <p><?php echo '$'.$cancel_payment; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">NOT PUBLISHED</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-6 align-self-center bgimageset text-center vl">
                       <label>Total Order</label>
                       <p><?php echo $pending_order; ?></p>
                    </div>
                    <div class="col-6 align-self-end align-self-center text-center vl">
                        <label>Total Amount</label>
                         <p><?php echo '$'.$pending_payment; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="card mb-2">
            <div class="card-body">
                 <h5 style="text-align: center;">GIVEN ORDER</h5>
                    <hr>
                <div class="d-flex">
                    <div class="col-4 align-self-center bgimageset text-center vl">
                       <label>Content Sales</label>
                       <p><?php echo '$'.$given_content_sales; ?></p>
                    </div>
                    <div class="col-4 align-self-center text-center vl">
                            <label>Link Sales</label>
                            <p><?php echo '$'.$given_link_sales; ?></p>                                                          
                    </div>
                    <div class="col-4 align-self-end align-self-center text-center vl">
                        <label>Total</label>
                         <p><?php echo '$'.($given_link_sales+$given_content_sales); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
