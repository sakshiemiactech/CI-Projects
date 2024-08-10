<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile Details</li>
                </ol>
            </div>
            <h4 class="page-title text-uppercase">Profile</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
<div class="row py-5">
	<div class="col-12">
    	<section id="user-profile">
    		<div class="row">
    			<div class="col-12">
    				<div class="card profile-with-cover mt-3">
    					<div class="card-img-top img-fluid bg-cover height-300"></div>
    					<div class="media profil-cover-details row">
    						<div class="col-12">
    							<div class="align-self-center halfway-fab text-center">
    								<a class="profile-image">
    									<img src="<?php if(!empty($user_info['photo'])){echo base_url('uploads/user_image/'.$user_info['photo']);}else{ echo base_url('assets/images/users/avatar-1.jpg'); } ?>" class="pf-image  rounded-circle img-border gradient-summer" width="120px" height="120" alt="Card image">
    								</a>
    							</div>
    						</div>
    					</div>
    					<div class="row">
    					    <div class="col-xs-12 col-md-12">
        					<form action="<?php echo base_url('upload_image'); ?>" enctype="multipart/form-data" id="" method="post">
                                <div>
                                    <input type="file" name="profile_image" class="choose-image mt-2 mb-4" data-url="<?php echo base_url('upload_image'); ?>" data-image="<?php echo base_url('uploads/user_image/'); ?>">
                                    <button type="submit" class="ml-4" style="">submit</button>
                                </div>
                            </form>
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</section>

    	<section class="my-2">
    		<div class="card m-b-30">
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills nav-justified py-4 theme-border-bottom" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#home-1" role="tab" aria-selected="true">View Profile</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active show" data-toggle="tab" href="#profile-1" role="tab" aria-selected="false">Edit Profile</a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#messages-1" role="tab" aria-selected="false">Change Password</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content py-4">
                        <div class="tab-pane p-3" id="home-1" role="tabpanel">
                            <div class="row pl-5">
                            	<div class="col-md-4 mb-4">
                            		<p class="font-bold">Name</p>
                            		<p><?php echo $user_info['name']; ?></p>
                            	</div>
                            	<div class="col-md-4 mb-4">
                            		<p class="font-bold">Mobile</p>
                            		<p><?php echo $user_info['phone']; ?></p>
                            	</div>
                            	<div class="col-md-4 mb-4">
                            		<p class="font-bold">Email</p>
                            		<p><?php echo $user_info['email']; ?></p>
                            	</div>
                            	<div class="col-md-4 mb-4">
                            		<p class="font-bold">Blog Url</p>
                            		<p><?php echo $user_info['blog_url']; ?></p>
                            	</div>
                            	<div class="col-md-4 mb-4">
                            		<p class="font-bold">Blog Category</p>
                            		<p><?php echo $user_info['blog_category']; ?></p>
                            	</div>
                                <div class="col-md-4 mb-4">
                                    <p class="font-bold">Activation Key</p>
                                    <p><?php echo $user_info['user_key']; ?></p>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <p class="font-bold">Distributor ID</p>
                                    <p><?php echo $user_info['davsy_distributor_id']; ?></p>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <p class="font-bold">User ID</p>
                                    <p><?php echo $user_info['davsy_user_id']; ?></p>
                                </div>
                            </div>
                            
                        </div>
                        <div class="tab-pane p-3 active show" id="profile-1" role="tabpanel">
                            <form action="<?php echo base_url('update_user');?>" method="post" class="form-redirect pt-3">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>Full Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" placeholder="Full Name" name="name" id="name" value="<?php echo $user_info['name'];?>"> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>Blog Category <span class="text-danger">*</span></label>
                                            <select class="form-control" id="blog_category" name="blog_category">
                                                <?php foreach($categories as $value){ ?>
                                                    <option value="<?php echo $value['id']; ?>" <?php if($user_info['blog_category'] == $value['id'])echo 'selected'; ?> > <?php echo $value['category_name']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>Distributor ID <span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" placeholder="Distributor ID" name="davsy_distributor_id" id="davsy_distributor_id" value="<?php echo $user_info['davsy_distributor_id'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>User ID <span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" placeholder="User ID" name="davsy_user_id" id="davsy_user_id" value="<?php echo $user_info['davsy_user_id'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input type="Email" class="form-control" placeholder="Email" readonly="readonly" value="<?php echo $user_info['email'];?>">
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label>Blog Url <span class="text-danger">*</span></label>
                                            <input type="text" readonly="readonly" class="form-control" placeholder="Blog Url" name="blog_url" id="blog_url" value="<?php echo $user_info['blog_url'];?>">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                
                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit">Save Form</button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="tab-pane p-3" id="messages-1" role="tabpanel">
                            <form action="<?php echo base_url('update_password'); ?>" method="post" class="form-redirect pt-3">
                            	<div class="row">
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label>Password</label>
                                			<div class="input-group">
                                				<input type="password" class="form-control" name="password" id="password">
                                				<div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi mdi-lock-outline"></i></span></div>
                                			</div>
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label>Confirm Password</label>
                                			<div class="input-group">
                                				<input type="password" class="form-control" name="confirm_password" id="confirm_password">
                                				<div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi mdi-lock-outline"></i></span></div>
                                			</div>
                            			</div>
                            		</div>
                            	</div>
                            	<div class="text-center mt-3">
                                    <button class="btn btn-primary" type="submit">Save Form</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    	</section>
	</div>
</div>