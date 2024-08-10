<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Davsy</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title text-uppercase">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row mt-3 justify-content-center">
    <div class="card text-white bg-primary mb-3 col-lg-3 col-md-3 ml-2" style="max-width: 16rem;">
      <div class="card-header davhead text-center">Total Post</div>
      <div class="card-body">
        <h5 class="card-title text-center"><?php echo $all_total['mypost']; ?></h5>
      </div>
    </div>
    <div class="card text-white bg-primary mb-3 col-lg-3 col-md-3 ml-2" style="max-width: 16rem;">
      <div class="card-header davhead text-center">Total Impressions</div>
      <div class="card-body">
        <h5 class="card-title text-center"><?php echo $all_total['myviews']; ?></h5>
        
      </div>
    </div>
    <div class="card text-white bg-primary mb-3 col-lg-3 col-md-3 ml-2" style="max-width: 16rem;">
      <div class="card-header davhead text-center">Total Clicks</div>
      <div class="card-body">
        <h5 class="card-title text-center"><?php echo $all_total['myclicks']; ?></h5>
        
      </div>
    </div>
    <div class="card text-white bg-primary mb-3 col-lg-3 col-md-3 ml-2" style="max-width: 16rem;">
      <div class="card-header davhead text-center">CTR</div>
      <div class="card-body">
        <h5 class="card-title text-center"><?php if(!empty($all_total['myclicks']) && !empty($all_total['myviews'])){echo number_format(($all_total['myclicks']/$all_total['myviews'])*100,3).'%';} ?></h5>
        
      </div>
    </div>
    <div class="col-lg-12 col-md-12 mt-3">
        <select class="dashboard_sort" id="sort_date" url="<?php echo base_url('dashboard/');?>">
            <option value="0" <?php if($sorted_by == 0)echo 'selected'; ?>>Daily</option>
            <option value="6" <?php if($sorted_by == 6)echo 'selected'; ?>>Weekly</option>
            <option value="30" <?php if($sorted_by == 30)echo 'selected'; ?>>Monthly</option>
        </select>
    </div>
    <div class="col-lg-6 col-md-6 mt-4">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto" class="graph"></div>
    </div>
    <div class="col-lg-6 col-md-6 mt-4">
        <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
</div>

