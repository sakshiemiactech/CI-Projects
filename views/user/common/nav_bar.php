<!-- Start right Content here -->
<style>.select2{
  width:100% !important;}
</style>
<div class="content-page">
<!-- Start content -->
<div class="content">
<!-- Top Bar Start -->
<div class="topbar">
  <nav class="navbar-custom" id="navbar">
    <ul class="list-inline mb-0" style="">
      <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('clients'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Clients
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 1%;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-whatever="@getbootstrap">CS</button>
      </li>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 1%;">
        <a href="https://writer.outreachdeal.com/content-panel/<?php echo rand(100000,999999).$this->session->user_login; ?>" target="_blank" class="suppa_menu_logo logo_left_menu_right">
        CL
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('users'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Users
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Vendor'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="<?php echo base_url('db'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Main
        </a>
      </li>
      <?php } ?>
		<?php if($this->session->role!='Admin'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 1%;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sksmodal" data-whatever="@getbootstrap">MSC</button>
      </li>
	 <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Vendors' || $this->session->role=='Manage'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="<?php echo base_url('vendors'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Vendors
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="<?php echo base_url('orders'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Orders
        </a>
      </li>
      <?php } ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="<?php echo base_url('published_url'); ?>" class="suppa_menu_logo logo_left_menu_right">
        PO
        </a>
      </li>
      <?php if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Manage'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="<?php echo base_url('operates'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Operate
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Salesperson'  || $this->session->role=='Operator'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 3%;">
        <a href="#" class="nav-link dropdown-toggle arrow-none waves-effect nav-user text-center" data-toggle="dropdown" href="#" role="button"
          aria-haspopup="false" aria-expanded="false">
        Finance
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
          <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson'){ ?>
          <a class="dropdown-item" href="<?php echo base_url('get-website'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Ordered sites</a>
          <?php } ?>
          <?php if($this->session->role=='Admin'){ ?>
          <a class="dropdown-item" href="<?php echo base_url('account'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Account</a>
          <a class="dropdown-item" href="<?php echo base_url('finance'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Client</a>
          <a class="dropdown-item" href="<?php echo base_url('client-report'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Client Report</a>
          <?php }elseif($this->session->role=='Salesperson'){ ?>
          <a class="dropdown-item" href="<?php echo base_url('client-report'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Client Report</a>
          <?php } ?>
          <?php if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Operator'){ ?>
          <a class="dropdown-item" href="<?php echo base_url('vendor-payment'); ?>"><i class="mdi mdi-logout m-r-5 text-muted"></i> Vendor</a>
          <?php } ?>
          <?php if($this->session->role=='Admin' || $this->session->role=='Manage'){ ?>
          <a class="dropdown-item" href="<?php echo base_url('vendor-report'); ?>"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Vendor Report</a>
          <?php } ?>
        </div>
      </li>
      <?php if($this->session->role=='Admin'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('reports'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Reports
        </a>
      </li>
      <?php } ?>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson' || $this->session->role=='Manage' || $this->session->role=='Vendors'  || $this->session->role=='Operator'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('aid'); ?>" class="suppa_menu_logo logo_left_menu_right">
        Aid
        </a>
      </li>
      <?php } ?>
      <?php if($this->session->role=='Admin' || $this->session->role=='Salesperson'){ ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('ss'); ?>" class="suppa_menu_logo logo_left_menu_right">
        SS
        </a>
      </li>
      <?php } ?>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('agencydata'); ?>" class="suppa_menu_logo logo_left_menu_right">
        AG
        </a>
      </li>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 2%;">
        <a href="<?php echo base_url('language-tool'); ?>" class="suppa_menu_logo logo_left_menu_right">
        LT
        </a>
      </li>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 1%;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">SC</button>
      </li>
      <li class="list-inline-item dropdown notification-list" style="padding-left: 1%;">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalvc" data-whatever="@getbootstrap">VC</button>
      </li>
      <li class="list-inline-item dropdown notification-list fnduser" style="padding-left: 4%;" data-url="" data-email="">
        <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user text-center" data-toggle="dropdown" href="#" role="button"
          aria-haspopup="false" aria-expanded="false">
        User
        </a>
        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
          <!-- item-->
          <div class="dropdown-item noti-title">
            <h5>
              Welcome 
              <p><?php echo ucfirst($user_info['name']);?></p>
            </h5>
          </div>
          <a class="dropdown-item" href="<?php echo base_url('logout');?>"><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a>
        </div>
      </li>
    </ul>
    <div class="clearfix"></div>
  </nav>
</div>
<?php 
  if($this->session->role == 'Admin' || $this->session->role == 'Manage'){
  $this->db->select('tbl_users.name as user_name, tbl_clients.*');
  $this->db->from('tbl_users');
  $this->db->join('tbl_clients', 'tbl_clients.user_id = tbl_users.id');
  $result = $this->db->get();
  $clients =  $result->result_array();	
  }else{
  
  $this->db->select('tbl_users.name as user_name, tbl_clients.*');
  $this->db->from('tbl_users');
  $this->db->where('tbl_clients.user_id',$this->session->user_id); 
  $this->db->join('tbl_clients', 'tbl_clients.user_id = tbl_users.id');
  $result = $this->db->get();
  $clients = $result->result_array();	
  } ?>
<!-- Top Bar End -->
<div class="page-content-wrapper">
<div class="container-fluid">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Site Check</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('check_sites'); ?>">
          <?php if($this->session->role == 'Salesperson' || $this->session->role == 'Admins'){ ?>
          <div class="form-group">
            <select name="client_name" class="form-control">
              <option value="">Client Name</option>
              <?php foreach($clients as $value){ ?>
              <option value="<?php echo $value['name']; ?>"> <?php echo $value['name']; ?> </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <select name="communication_id" class="js-example-basic-single-one form-control" data-url="">
              <option value="">Contacted ID</option>
              <option value="yogesh fiverr">yogesh fiverr</option>
              <option value="sales@outreachdeal.com">sales@outreachdeal.com	</option>
              <option value="kunika@emiactech.com">kunika@emiactech.com</option>
              <option value="care@outreachdeal.com">care@outreachdeal.com</option>
              <option value="abhishekoutreachdeal@gmail.com">abhishekoutreachdeal@gmail.com</option>
              <option value="pr@emiactech.com">pr@emiactech.com</option>
              <option value="divyagandotra@emiactech.com">divyagandotra@emiactech.com</option>
              <option value="Shivam Upwork">Shivam Upwork</option>
              <option value="Divya Upwork">Divya Upwork</option>
              <option value="Yogesh Upwork">Yogesh Upwork</option>
              <option value="Fiverr">Fiverr</option>
            </select>
          </div>
          <?php } ?>
          <div class="form-group">
            <select name="table_name" class="form-control">
              <option value="tbl_sites" selected>Main Site Check</option>
              <option value="tbl_olt">Language Site Check</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Format Ex. smalltownveteran,herbalsuite</label>
            <textarea rows="10" class="form-control" id="message-text" name="site_check"></textarea>
          </div>
          <div class="form-group">
            <label for="communication_id" class="col-form-label">Enter the Pitch ID</label>
            <input type="input" class="form-control" id="communication_id" name="communication_id"  style="">
          </div>
          <div class="form-group">
            <label for="save-data" class="col-form-label">Check this if you want to save data</label>
            <input type="checkbox" class="form-control" id="save-data" name="save_data" value="yes" style="margin-left: -48%;height: 20px;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Check</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalvc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Site Check</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('check_vendors'); ?>">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Format Ex. smalltownveteran,herbalsuite</label>
            <textarea rows="10" class="form-control" id="message-text" name="vendor_check"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Check</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Site Check</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('sent_sites'); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <select name="client_name" class="form-control">
              <option value="">Client Name</option>
              <?php foreach($clients as $value){ ?>
              <option value="<?php echo $value['name']; ?>"> <?php echo $value['name']; ?> </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <select name="communication_id" class="js-example-basic-single-one form-control" data-url="">
              <option value="">Contacted ID</option>
              <option value="yogesh fiverr">yogesh fiverr</option>
              <option value="sales@outreachdeal.com">sales@outreachdeal.com	</option>
              <option value="kunika@emiactech.com">kunika@emiactech.com</option>
              <option value="care@outreachdeal.com">care@outreachdeal.com</option>
              <option value="abhishekoutreachdeal@gmail.com">abhishekoutreachdeal@gmail.com</option>
              <option value="pr@emiactech.com">pr@emiactech.com</option>
              <option value="divyagandotra@emiactech.com">divyagandotra@emiactech.com</option>
              <option value="Shivam Upwork">Shivam Upwork</option>
              <option value="Divya Upwork">Divya Upwork</option>
              <option value="Yogesh Upwork">Yogesh Upwork</option>
              <option value="Fiverr">Fiverr</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Upload sheet</label>
            <input type="file" name="import">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="sksmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Site Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('find-aid'); ?>">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Upload sheet</label>
            <textarea rows="10" class="form-control" id="message-text" name="multiple_site_check" spellcheck="false"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>