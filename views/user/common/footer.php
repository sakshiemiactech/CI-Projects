                        </div><!-- container -->
                    </div> <!-- Page content Wrapper -->
                </div> <!-- content -->
                <footer class="footer row">
                    © <?php echo date('Y');?> Davsy.
                </footer>
            </div>
            <!-- End Right content here -->
        </div>
        <!-- END wrapper -->
        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
        
        <script src="<?php echo base_url('assets/js/main.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/toastr.min.js');?>"></script>
        
        <!-- App js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="<?php echo base_url('assets/js/app.js');?>"></script>
        <script src="<?php echo base_url('assets/js/custom.js');?>"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>

        <?php
            if(isset($scripts)) {
                foreach($scripts as $script) {
            ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js/'.$script); ?>"></script>
            <?php
                }
            }
        ?>       
       
        <script type="text/javascript">
            $(document).ready( function () {
                $(".js-example-basic-single-one").select2({closeOnSelect:false,tags: true});
                $(".js-example-basic").select2({closeOnSelect:false,tags: true});
                
                $('#myTable').DataTable({"lengthMenu": [[10, 20,<?php if($this->session->role == 'Admin'){ ?>-1 <?php } ?>], [10, 20,<?php if($this->session->role == 'Admin'){ ?>"All"<?php } ?>]],"scrollX": true,"order": [[ 1, "desc" ]],"pageLength": 20<?php if($this->session->role == 'Admin'){ ?>,dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],dom: 'Blfrtip',
										 "columnDefs": [
    { className: "my_class", "targets": "_all" }
  ],
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]<?php } ?>});
        
        $('#myTable1').DataTable({"lengthMenu": [[10,20,<?php if($this->session->role == 'Admin'){ ?>-1 <?php } ?>], [10, 20,<?php if($this->session->role == 'Admin'){ ?>"All"<?php } ?>]],"scrollX": true,"order": [[ 0, "desc" ]],"pageLength": 20,dom: 'Blfrtip',
        buttons: [
            <?php if($this->session->role == 'Admin'){ ?>'copy', 'csv', 'excel', 'pdf',<?php } ?> 'print'
        ],dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'
        ]});
        
            } );
            $('.turl').click(function(){
                var url = $(this).data('url');
                var range = $('#sel1').val();
                var main_url = url+'/'+range;
                window.location.href=main_url;
            });
            
            
            
        </script>
        <script>
            /*var prevScrollpos = window.pageYOffset;
            window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
              if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "20";
              } else {
                document.getElementById("navbar").style.top = "-50px";
              }
              prevScrollpos = currentScrollPos;
            }*/
            </script>
            <script>
    $(document).ready(function() {
        count = 1;
        $('.add_web').on('click',function(){
            var uni = 'unik'+count;
            count++;
        $('.append_it').find('select').addClass(uni);
		var web_prop = $('.append_it').html();
		$('.main_divs').append(web_prop);
		$('.append_it').find('select').removeClass(uni);
		for (var i = 1; i < 50; i++) { 
			var skcount = i;
			$('.selUser.unik'+skcount).select2({
  ajax: { 
   url: "https://outreach.emiactech.com/get_web",
   type: "post",
   dataType: 'json',
   delay: 250,
   data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
 }); 
		}
        });	
	});
	$(document).on('click','.delete_row',function(){
		$(this).parent().parent().remove();
	});
	
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script>
  $( function() {
    $( "#order_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );
  $( function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

$('.client_name').change(function(){
	var client_id = $(this).val();
	var url =  $(this).data('url');
	if(client_id){
    	url = url+client_id;
    	$.post(url,function(data){
    	   $('.client_email').val(data); 
    	});
	}else{
	    $('.client_email').val();
	}
});
/*$this->db->or_like(array('id' => $sk['search']['value'], 'website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value']
,'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'remark'=>$sk['search']['value'],'dr'=>$sk['search']['value'],
'spam_score'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'discount'=>$sk['search']['value'],'casino_adult'=>$sk['search']['value'],));*/

  </script>
    <script>
        $(document).ready(function() {
    var table =  $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "method":"post",
        "ajax": "<?php echo base_url();?>tabdata",
        "deferLoading": <?php if(isset($count)){ echo $count; } else{ echo 0; } ?>,
        "columns": [
        
        { mData: 'website' },
        { mData: 'pure_category' },
        { mData: 'niche'},
		{ mData: 'site_category'},
        { mData: 'da' },
        { mData: 'pa' },
        { mData: 'price' },
        { mData: 'sailing_price' },
        { mData: 'remark' },
        { mData: 'semrush_traffic' },
        { mData: '1st' },
        { mData: '2nd' },
        { mData: '3rd' },
        { mData: '4th' },
        { mData: 'dr' },
        { mData: 'spam_score' },
        { mData: 'price_category' },
        { mData: 'sailing_price' },
        { mData: 'discount' },
        { mData: 'casino_adult' } ,
        { mData: 'traffic' },
        { mData: 'web_category' },
        { mData: 'vendor_name' },
        { mData: 'vendor_email' },
        { mData: 'vendor_contact' },
        { mData: 'follow' },
        { mData: 'cp_update_date' },
        { mData: 'phone_numbers' },
        { mData: 'timestamp' },
        { mData: 'web_ip' },
        { mData: 'web_country' },
        { mData: 'link_insertion_cost' },
        { mData: 'tat' },
        { mData: 'social_media_posting' },
        {"mRender": function ( data, type, row ) {
                        return '<a href=add-site/'+row.id+' class="tabledit-edit-button btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit"><span class="ti-pencil"></span></a><button type="button" class="tabledit-delete-button btn btn-sm btn-danger delete" data-id="'+row.id+'" data-url="https://outreach.emiactech.com/delete_sites" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete"><span class="ti-trash"></span></button>';
                    }
                }
        ],
         "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull ) {
            if ( mData.web_category == "Com & Agency" )
            {
                $('td', nRow).css('background-color', 'cadetblue');
            }else if ( mData.web_category == "Agency" )
            {
                $('td', nRow).css('background-color', 'khaki');
            }else if ( mData.web_category == "Community" )
            {
                $('td', nRow).css('color', 'red');
            }
            
        },"scrollX": true,orderCellsTop: true,fixedHeader: true,"lengthMenu": [[10], [10]],"pageLength": 10,dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis']
    });
    
     $('.example thead tr').clone(true).appendTo( '.example thead' );
            $('.example thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" id="'+title+'" placeholder="Search '+title+'" />' );
         
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
             });
             
             $('#end_da').on('change', function(){
                    var from_da = parseInt($('#start_da').val());
                    var to_da = parseInt($('#end_da').val());
                    if(to_da > from_da && !isNan(from_da) && !isNan(to_da)){
                        var final_da = from_da+','+to_da;
                        table.column(3).search(final_da).draw();
                    }
                    
                });
            });
            
            
    </script>
    
    <script>
        $(document).ready(function() {
    var table =  $('#aid_table').DataTable( {  
        "processing": true,
        "serverSide": true,
        "method":"post",
        "ajax": "<?php echo base_url();?>aidata",
        "deferLoading": <?php if(isset($count)){ echo $count; } else{ echo 0; } ?>,
        "columns": [
        
        { mData: 'website' },
        { mData: 'remark' },
		{ mData: 'pure_category' },
        { mData: 'niche'},
		{ mData: 'site_category'},
		{ mData: 'website_type'},
        { mData: 'cp_update_date'},
        { mData: 'da' },
        { mData: 'pa' },
        { mData: 'dr' },
        { mData: 'spam_score' },
        { mData: 'price' },
        { mData: 'sailing_price' },
        { mData: 'traffic' },
        { mData: 'follow' },
        { mData: 'semrush_traffic' },
        { mData: 'semrush_india' },
        { mData: 'semrush_us' },
        { mData: 'semrush_uk' },
        { mData: 'semrush_australia' },
        { mData: 'semrush_updation_date' },								   	
        { mData: 'vendor_name' },
        { mData: 'link_insertion_cost' },
        { mData: 'tat' },
        { mData: 'social_media_posting' },
        { mData: 'web_category' },
        { mData: 'casino_adult' } ,
        { mData: 'cbd_price' } ,
        { mData: 'adult' } ,
        { mData: 'banner_image_price' },
        { mData: 'sample_url' },
        { mData: 'site_update_date' }
        ],
        columnDefs: [ {targets: 29,render: function ( mData, type, row ) {return '<a href="'+mData+'" target="_blank">'+mData.substr( 0, 20 )+'</a>';} } ],
         "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull ) {
            if ( mData.web_category == "Com & Agency" )
            {
                $('td', nRow).css('background-color', 'cadetblue');
            }else if ( mData.web_category == "Agency" )
            {
                $('td', nRow).css('background-color', 'khaki');
            }else if ( mData.web_category == "Community" )
            {
                $('td', nRow).css('color', 'red');
            }else if ( mData.remark != "" )
            {
                $('td', nRow).css('background-color', '#00fbff6b');
            }else if ( mData.nows > 1 )
            {
                $('td', nRow).css('background-color', 'orange');
            }
            
        },"scrollX": true,orderCellsTop: true,fixedHeader: true,"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],"pageLength": 20,dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'],columnDefs: [{
                      targets: [1],
                      createdCell: function(cell) {
                        var $cell = $(cell);
                
                
                        $(cell).contents().wrapAll("<div class='content'></div>");
                        var $content = $cell.find(".content");
                
                        $(cell).append($("<button class='rdmrbtn'>Read more</button>"));
                        $btn = $(cell).find("button");
                
                        $content.css({
                          "width": "100px",
                          "overflow": "hidden"
                        })
                        $cell.data("isLess", true);
                
                        $btn.click(function() {
                          var isLess = $cell.data("isLess");
                          $content.css("width", isLess ? "auto" : "100px")
                          $(this).text(isLess ? "Read less" : "Read more")
                          $cell.data("isLess", !isLess)
                        })
                      }
                    }]
    });
    
     $('.aid_table thead tr').clone(true).appendTo( '.aid_table thead' );
            $('.aid_table thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" id="'+title+'" placeholder="Search '+title+'" />' );
         
                $( 'input', this ).on( 'keyup change', function () { 
                    if ( table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
             });
             
             $('.datefilter').on('change', function(){
                    var from_da = parseInt($('#start_da').val());
                    var to_da = parseInt($('#end_da').val());
                    if(to_da > from_da && !isNan(from_da) && !isNan(to_da)){
                        var final_da = from_da+','+to_da;
                        table.column(3).search(final_da).draw();
                    }
                    
                });
                
            jQuery('.datefilter').on("change",function(){
                var date = $(this).val();
                table.column(30).search(date).draw();
            });
			jQuery('.web_type').on("change",function(){
                var type = $(this).val();
                table.column(5).search(type).draw();
            });
            });
            
             $(document).bind("contextmenu",function(e){
                 var sess = '<?php echo $this->session->user_id; ?>';
                 if(sess != 2){
                     return false;
                 }
            });
        $('.blkasgn').on('click',function(){
            //event.preventDefault();
            var skcount = 0;
            var blkhtml = '';
	        var num = 0;
	        var ids = '';
	        var pmam = '';
    	    $('.muledit').each(function(){
    	       if($(this).prop("checked") == true){
    	           ids = $(this).val();
    	           pmam = $(this).attr('amrc');
    	           skcount = skcount+1; 
    	           blkhtml = blkhtml+'<div class="col-md-1 mb-1 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-1 mb-1"><div class="form-group"><label>Amount</label><input type="text" class="form-control" placeholder="" name="client_amount_received[]" id="" value="'+pmam+'"> </div></div><div class="col-md-2 mb-2"><div class="form-group"><label>A. A. Received</label><input type="text" class="form-control" placeholder="" name="actual_received_amount[]" id="" value=""></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="client_amount_received_date[]" id="" value=""></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Received Status <span class="text-danger">*</span></label><select name="client_amount_received_status[]" class="js-example-basic-single-one form-control"><option value="Received"> Received </option><option value="Partially_Received"> Partially_Received </option><option value="Not_Received"> Not_Received </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Account Type <span class="text-danger">*</span></label><select name="client_account_type[]" class="js-example-basic-single-one form-control"><option value="Paypal"> Paypal </option><option value="Eminence"> Eminence </option><option value="Emiac"> Emiac </option><option value="shivam_upwork"> Shivam Upwork </option><option value="divya_upwork"> Divya Upwork </option><option value="yogesh_upwork"> Yogesh Upwork </option><option value="company_upwork"> Company Upwork </option><option value="Other"> Other </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Account Name</label><input type="text" class="form-control" placeholder="" name="client_account_id[]" id="" value=""></div></div>';
    	       } 
    	    });
    	    $('.blkedit').html(blkhtml);
    	    $( ".datepickersp" ).datepicker({ dateFormat: 'yy-mm-dd' });
            if(skcount == 0){
                alert('Please select orders for assining to writer');
                return false;
            }
        }); 
        
        $('.quickedit').on('click',function(){
            var main_id = $(this).data('id');
            var status = $(this).data('status');
            var assign_date = $(this).data('assigndate');
            var publish_date = $(this).data('publishdate');
            var publish_url = $(this).data('publishurl');
            $('#assign_date').val(assign_date);
            $('#publish_date').val(publish_date);
            $('#publish_url').val(publish_url);
            $('#update_id').val(main_id);
            $("#status option:contains(" + status + ")").attr('selected', 'selected');
            $('#select2-status-container').text(status);
            
        });
        
        $('.quickeditpayment').on('click',function(){
            var main_id = $(this).data('id');
            var cost_price = $(this).data('cp');
            var pstatus = $(this).data('pstatus');
            var payment_date = $(this).data('pdate');
            var invoice_status = $(this).data('istatus');
            var actual_paid = $(this).data('ap');
            var transaction_id = $(this).data('tid');
            $('#vendor_transaction_id').val(transaction_id);
            $('#cost_price').val(cost_price);
            $('#vendor_payment_date').val(payment_date);
            $('#actual_paid_amount').val(actual_paid);
            $('#order_id').val(main_id);
            $("#vendor_payment_status option:contains(" + pstatus + ")").attr('selected', 'selected');
            $('#select2-vendor_payment_status-container').text(pstatus);
            $("#vendor_invoice_status option:contains(" + invoice_status + ")").attr('selected', 'selected');
            $('#select2-vendor_invoice_status-container').text(invoice_status);
            
        });
         
        
        $('.blkasgned').on('click',function(){
            //event.preventDefault();
            var skcount = 0;
            var blkhtml = '';
	        var num = 0;
	        var ids = '';
	        var pmam = '';
    	    $('.muledit').each(function(){
    	       if($(this).prop("checked") == true){
    	           ids = $(this).val();
    	           assign_date = $(this).data('assigndate');
    	           status = $(this).data('status');
    	           publish_date = $(this).data('publishdate');
    	           publish_url = $(this).data('publishurl');
    	           remark = $(this).data('vendormark');
    	           skcount = skcount+1;
    	           if(status == 'Pending'){
    	               blkhtml = blkhtml+'<div class="col-md-2 mb-2 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Assign Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="assign_date[]" id="" value="'+assign_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select name="status[]" class="js-example-basic-single-one form-control"><option value="Pending"> Pending </option><option value="Given"> Given </option><option value="Publish"> Publish </option><option value="Not_Publish"> Not_Publish </option><option value="Cancel"> Cancel </option><option value="Replacement"> Replacement </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="publish_date[]" id="" value="'+publish_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish URL</label><input type="text" class="form-control" placeholder="" name="publish_url[]" id="" value="'+publish_url+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Remark</label><input type="text" class="form-control" placeholder="" name="remark[]" id="" value="'+remark+'"></div></div>';
    	           }else if(status == 'Given'){
    	               blkhtml = blkhtml+'<div class="col-md-2 mb-2 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Assign Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="assign_date[]" id="" value="'+assign_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select name="status[]" class="js-example-basic-single-one form-control"><option value="Given"> Given </option><option value="Pending"> Pending </option><option value="Publish"> Publish </option><option value="Not_Publish"> Not_Publish </option><option value="Cancel"> Cancel </option><option value="Replacement"> Replacement </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="publish_date[]" id="" value="'+publish_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish URL</label><input type="text" class="form-control" placeholder="" name="publish_url[]" id="" value="'+publish_url+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Remark</label><input type="text" class="form-control" placeholder="" name="remark[]" id="" value="'+remark+'"></div></div>';
    	           }else if(status == 'Publish'){
    	               blkhtml = blkhtml+'<div class="col-md-2 mb-2 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Assign Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="assign_date[]" id="" value="'+assign_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select name="status[]" class="js-example-basic-single-one form-control"><option value="Publish"> Publish </option><option value="Pending"> Pending </option><option value="Given"> Given </option><option value="Not_Publish"> Not_Publish </option><option value="Cancel"> Cancel </option><option value="Replacement"> Replacement </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="publish_date[]" id="" value="'+publish_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish URL</label><input type="text" class="form-control" placeholder="" name="publish_url[]" id="" value="'+publish_url+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Remark</label><input type="text" class="form-control" placeholder="" name="remark[]" id="" value="'+remark+'"></div></div>';
    	           }else if(status == 'Cancel'){
    	               blkhtml = blkhtml+'<div class="col-md-2 mb-2 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Assign Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="assign_date[]" id="" value="'+assign_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select name="status[]" class="js-example-basic-single-one form-control"><option value="Cancel"> Cancel </option><option value="Pending"> Pending </option><option value="Given"> Given </option><option value="Publish"> Publish </option><option value="Not_Publish"> Not_Publish </option><option value="Replacement"> Replacement </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="publish_date[]" id="" value="'+publish_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish URL</label><input type="text" class="form-control" placeholder="" name="publish_url[]" id="" value="'+publish_url+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Remark</label><input type="text" class="form-control" placeholder="" name="remark[]" id="" value="'+remark+'"></div></div>';
    	           }else{
    	               blkhtml = blkhtml+'<div class="col-md-2 mb-2 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Assign Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="assign_date[]" id="" value="'+assign_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Status <span class="text-danger">*</span></label><select name="status[]" class="js-example-basic-single-one form-control"><option value="Pending"> Pending </option><option value="Given"> Given </option><option value="Publish"> Publish </option><option value="Not_Publish"> Not_Publish </option><option value="Cancel"> Cancel </option><option value="Replacement"> Replacement </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="publish_date[]" id="" value="'+publish_date+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Publish URL</label><input type="text" class="form-control" placeholder="" name="publish_url[]" id="" value="'+publish_url+'"></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Remark</label><input type="text" class="form-control" placeholder="" name="remark[]" id="" value="'+remark+'"></div></div>';
    	           }
    	           
    	           
    	       } 
    	    });
    	    $('.blkedit').html(blkhtml);
    	    $( ".datepickersp" ).datepicker({ dateFormat: 'yy-mm-dd' });
            if(skcount == 0){
                alert('Please select orders for assining to writer');
                return false;
            }
        }); 
        
        $('.vendorpupdate').on('click',function(){
            //event.preventDefault();
            var skcount = 0;
            var blkhtml = '';
	        var num = 0;
	        var ids = '';
	        var pmam = '';
    	    $('.muledit').each(function(){
    	       if($(this).prop("checked") == true){
    	           ids = $(this).val();
    	           pmam = $(this).attr('amrc');
    	           skcount = skcount+1; 
    	           blkhtml = blkhtml+'<div class="col-md-1 mb-1 skblon"><div class="form-group"><label>O.ID <span class="text-danger">*</span></label><input type="text" readonly class="form-control" autocomplete="off" placeholder=""  name="order_ids[]" id="" value="'+ids+'"></div></div><div class="col-md-1 mb-1"><div class="form-group"><label>Amount</label><input type="text" class="form-control" placeholder="" disabled id="" value="'+pmam+'"> </div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Actual Paid</label><input type="text" class="form-control" placeholder="" name="actual_paid_amount[]" id="" value=""></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Date<span class="text-danger">*</span></label><input type="text" class="form-control datepickersp" placeholder="" name="vendor_payment_date[]" id="" value=""></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Invoice Status <span class="text-danger">*</span></label><select name="vendor_invoice_status[]" class="js-example-basic-single-one form-control"><option value="Pending"> Pending </option><option value="Ask"> Ask </option><option value="Recieved"> Recieved </option><option value="Given"> Given </option><option value="Paid"> Paid </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Payment Status <span class="text-danger">*</span></label><select name="vendor_payment_status[]" class="js-example-basic-single-one form-control"><option value="Hold"> Hold </option><option value="Paid"> Paid </option><option value="Partially_Paid">Partially_Paid </option><option value="Ready"> Ready </option><option value="Cancel"> Cancel </option></select></div></div><div class="col-md-2 mb-2"><div class="form-group"><label>Transaction ID</label><input type="text" class="form-control" placeholder="" name="vendor_transaction_id[]" id="" value=""></div></div>';
    	       } 
    	    });
    	    $('.blkedit').html(blkhtml);
    	    $( ".datepickersp" ).datepicker({ dateFormat: 'yy-mm-dd' });
            if(skcount == 0){
                alert('Please select orders for assining to writer');
                return false;
            }
        }); 
        
    </script>
    
    <script>
        $(document).ready(function() {
    var table =  $('#aid_table1').DataTable( {  
        "processing": true,
        "serverSide": true,
        "method":"post",
        "ajax": "<?php echo base_url();?>agendata",
        "deferLoading": <?php if(isset($count)){ echo $count; } else{ echo 0; } ?>,
        "columns": [
        { mData: 'website' },
        { mData: 'niche' },
        { mData: 'da' },
        { mData: 'pa'},
        { mData: 'web_category'},
        { mData: 'age'},
        { mData: 'price' },
        { mData: 'note' },
        { mData: '<?php if($this->session->role!='Salesperson'){ echo 'person'; } else{ echo 'min_words'; } ?>' },
        { mData: '<?php if($this->session->role!='Salesperson'){ echo 'contact'; } else{ echo 'min_words'; } ?>' },
        { mData: '<?php if($this->session->role!='Salesperson'){ echo 'contact_from'; } else{ echo 'min_words'; } ?>' },
        { mData: 'follow' },
        { mData: 'spam_score' },
        { mData: 'sample_url' },
        { mData: 'link_price' },
        { mData: 'min_words' },
        { mData: 'traffic2' },
        { mData: 'ahref_traffic' },
        { mData: 'related_price' },
        { mData: 'links' },
        { mData: 'site_description' },
        { mData: 'casino_cbd' },
        { mData: 'tat' },
        { mData: 'rd' },
        { mData: 'ar' },
        { mData: 'dr' },
        { mData: 'cf' } ,
        { mData: 'tf' } ,
        { mData: 'indexd' }
        ],
        columnDefs: [ {targets: 29,render: function ( mData, type, row ) {return '<a href="'+mData+'" target="_blank">'+mData.substr( 0, 20 )+'</a>';} } ],
         "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull ) {
            if ( mData.web_category == "Com & Agency" )
            {
                $('td', nRow).css('background-color', 'cadetblue');
            }else if ( mData.web_category == "Agency" )
            {
                $('td', nRow).css('background-color', 'khaki');
            }else if ( mData.web_category == "Community" )
            {
                $('td', nRow).css('color', 'red');
            }else if ( mData.remark != "" )
            {
                $('td', nRow).css('background-color', '#00fbff6b');
            }
            
        },"scrollX": true,orderCellsTop: true,fixedHeader: true,"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],"pageLength": 20,dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'],columnDefs: [{
                      targets: [1],
                      createdCell: function(cell) {
                        var $cell = $(cell);
                
                
                        $(cell).contents().wrapAll("<div class='content'></div>");
                        var $content = $cell.find(".content");
                
                        $(cell).append($("<button class='rdmrbtn'>Read more</button>"));
                        $btn = $(cell).find("button");
                
                        $content.css({
                          "width": "100px",
                          "overflow": "hidden"
                        })
                        $cell.data("isLess", true);
                
                        $btn.click(function() {
                          var isLess = $cell.data("isLess");
                          $content.css("width", isLess ? "auto" : "100px")
                          $(this).text(isLess ? "Read less" : "Read more")
                          $cell.data("isLess", !isLess)
                        })
                      }
                    }]
    });
    
     $('.aid_table1 thead tr').clone(true).appendTo( '.aid_table1 thead' );
            $('.aid_table1 thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" id="'+title+'" placeholder="Search '+title+'" />' );
         
                $( 'input', this ).on( 'keyup change', function () { 
                    if ( table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
             });
             
             $('#end_da').on('change', function(){
                    var from_da = parseInt($('#start_da').val());
                    var to_da = parseInt($('#end_da').val());
                    if(to_da > from_da && !isNan(from_da) && !isNan(to_da)){
                        var final_da = from_da+','+to_da;
                        table.column(3).search(final_da).draw();
                    }
                    
                });
            });
        $('#chngvndr').click(function(){
            $('.vndinf').toggle();
        });
    </script>
    
    <script>
        $(document).ready(function() {
    var table =  $('#language_table').DataTable( {  
        "processing": true,
        "serverSide": true,
        "method":"post",
        "ajax": "<?php echo base_url();?>languagedata",
        "deferLoading": <?php if(isset($count)){ echo $count; } else{ echo 0; } ?>,
        "columns": [
        
        { mData: 'website' },
        { mData: 'remark' },
        { mData: 'niche'},
        { mData: 'site_category'},
        { mData: 'language'},
        { mData: 'da' },
        { mData: 'pa' },
        { mData: 'dr' },
        { mData: 'spam_score' },
        { mData: 'price' },
        { mData: 'sailing_price' },
        { mData: 'traffic' },
        { mData: 'follow' },
        { mData: 'semrush_traffic' },
        { mData: 'similarweb_traffic' },
        { mData: '1st' },
        { mData: '2nd' },
        { mData: '3rd' },
        { mData: '4th' },
        { mData: '5th' },
        { mData: 'vendor_name' },
        { mData: 'link_insertion_cost' },
        { mData: 'tat' },
        { mData: 'social_media_posting' },
        { mData: 'web_category' },
        { mData: 'casino_adult' } ,
        { mData: 'cbd_price' } ,
        { mData: 'adult' } ,
        { mData: 'web_country' },
        { mData: 'sample_url' },
        { mData: 'timestamp' }
        ],
        columnDefs: [ {targets: 29,render: function ( mData, type, row ) {return '<a href="'+mData+'" target="_blank">'+mData.substr( 0, 20 )+'</a>';} } ],
         "fnRowCallback": function( nRow, mData, iDisplayIndex, iDisplayIndexFull ) {
            if ( mData.web_category == "Com & Agency" )
            {
                $('td', nRow).css('background-color', 'cadetblue');
            }else if ( mData.web_category == "Agency" )
            {
                $('td', nRow).css('background-color', 'khaki');
            }else if ( mData.web_category == "Community" )
            {
                $('td', nRow).css('color', 'red');
            }else if ( mData.remark != "" )
            {
                $('td', nRow).css('background-color', '#00fbff6b');
            }else if ( mData.nows > 1 )
            {
                $('td', nRow).css('background-color', 'orange');
            }
            
        },"scrollX": true,orderCellsTop: true,fixedHeader: true,"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],"pageLength": 20,dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],dom: 'Blfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 5 ]
                }
            },
            'colvis'],columnDefs: [{
                      targets: [1],
                      createdCell: function(cell) {
                        var $cell = $(cell);
                
                
                        $(cell).contents().wrapAll("<div class='content'></div>");
                        var $content = $cell.find(".content");
                
                        $(cell).append($("<button class='rdmrbtn'>Read more</button>"));
                        $btn = $(cell).find("button");
                
                        $content.css({
                          "width": "100px",
                          "overflow": "hidden"
                        })
                        $cell.data("isLess", true);
                
                        $btn.click(function() {
                          var isLess = $cell.data("isLess");
                          $content.css("width", isLess ? "auto" : "100px")
                          $(this).text(isLess ? "Read less" : "Read more")
                          $cell.data("isLess", !isLess)
                        })
                      }
                    }]
    });
    $('.countryspecific').on('click', function(){
       var text = $(this).text();
		text = text+'@';
       //alert(text);
       table.column(4).search(text).draw();
    });
     $('.language_table thead tr').clone(true).appendTo( '.language_table thead' );
            $('.language_table thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" id="'+title+'" placeholder="Search '+title+'" />' );
         
                $( 'input', this ).on( 'keyup change', function () { 
                    if ( table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
             });
             
             $('#end_da').on('change', function(){
                    var from_da = parseInt($('#start_da').val());
                    var to_da = parseInt($('#end_da').val());
                    if(to_da > from_da && !isNan(from_da) && !isNan(to_da)){
                        var final_da = from_da+','+to_da;
                        table.column(3).search(final_da).draw();
                    }
                    
                });
            });
$(document).on("change",'.iiiiselect2-search__field',function(evt){
			var web = $(this).val();
			    var main_url = 'http://localhost/get_web/'+web;
    			$.post(main_url,function(data){				
    				$('.website').html(data);
    			});
		});
		$(document).on("keyup",'.select2-search__fieldss',function(){
			var web = $(this).val();
			if(web.length > 2){
			
			}
		});
$(document).ready(function(){

 $(".firstoneselect").select2({
  ajax: { 
   url: "http://localhost/get_web",
   type: "post",
   dataType: 'json',
   delay: 250,
   data: function (params) {
    return {
      searchTerm: params.term // search term
    };
   },
   processResults: function (response) {
     return {
        results: response
     };
   },
   cache: true
  }
 });
});
    </script>
<script>
$("#selectAll").click(function(){

        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
		</script>
    </body>
</html>