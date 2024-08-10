<!-- Begin page -->
<div class="accountbg"></div>
<div class="black-shade"></div>
<div class="wrapper-page">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center mt-0 m-b-15">
                <a href="https://davsy.com/" class="logo logo-admin">
                    <img src="<?php echo base_url('assets/images/davsy-logo.png');?>">
                </a>
            </h3>
            <div class="p-3">
                <form class="form-horizontal login-form form-redirect" method="post" action="<?php echo base_url('do-register'); ?>">
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-user"></i></span>
                            </div>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-mobile"></i></span>
                            </div>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Mobile Number Without Prefix">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-email"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-lock"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-world"></i></span>
                            </div>
                            <input type="url" name="blog_url" class="form-control" id="blog_url" placeholder="Blog Url ( EX: https://davsy.com/ )">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ti-list"></i></span>
                            </div>
                            <select class="form-control" id="blog_category" name="blog_category">
                                <option value=""> Select Blog Category </option>
                                <?php foreach($categories as $value){ ?>
                                    <option value="<?php echo $value['id']; ?>"> <?php echo $value['category_name']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                   <div class="form-group input-group form-check">
                        <div class="input-group mb-1">
                            <input type="checkbox" class="form-check-input" name="terms" id="terms">
                            <label class="form-check-label" for="terms"><label for="checkbox" class="grey-text">I agree to the <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">Terms &amp; Conditions.</a></label></label>
                        </div>
                    </div>
                    <div class="form-group text-center row m-t-20">
                        <div class="col-12">
                            <button class="btn mt-5 btn-danger btn-block waves-effect waves-light" type="submit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="float-right">
                Already a member?<a href="<?php echo base_url(); ?>"> Login</a>
            </div>
            
        </div>
    </div>
</div>
<!-- Large modal -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
           <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          DAVSY ("us", "we", or "our") operates the https://davsy.com/ website (hereinafter referred to as the "Service").  
        </p>
        <p>
          This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.   
        </p>
        <p>
          We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy. Unless otherwise defined in this Privacy Policy, the terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, accessible from https://davsy.com/  
        </p>
        <h5>DEFINITIONS</h5>
        <h6>SERVICE</h6>
        <p>
           Service is the https://davsy.com/ website operated by DAVSY 
        </p>
        <h6>PERSONAL DATA</h6>
        <p>
          Personal Data means data about a living individual who can be identified from those data (or from those and other information either in our possession or likely to come into our possession).  
        </p>
         <h6>USAGE DATA</h6>
        <p>
           Usage Data is data collected automatically either generated by the use of the Service or from the Service infrastructure itself (for example, the duration of a page visit). 
        </p>
         <h6>COOKIES</h6>
        <p>
            Cookies are small files stored on your device (computer or mobile device).
        </p>
         <h6>INFORMATION COLLECTION AND USE</h6>
        <p>
            We collect several different types of information for various purposes to provide and improve our Service to you.
        </p>
         <h5>
             TYPES OF DATA COLLECTED
         </h5>
         <h6>PERSONAL DATA</h6>
        <p>
           While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). Personally identifiable information may include, but is not limited to:</br>
           <b>Email address</b></br>
           <b>Name</b></br>
           <b>Phone number</b></br>
           <b>Cookies and Usage Data</b>
           
        </p>
         <h6>USAGE DATA</h6>
        <p>
            We may also collect information how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g. IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers and other diagnostic data.   
        </p>
         <h6>URL DATA</h6>
        <p>
          <b>We collect information related to your personal site/blog URL. This URL Data may include information such as URL of your Site/Blog, Blog Post Images, Blog Post Link, Title of Blog Posts and other diagnostic data as required.</b>  
        </p>
         <h6>TRACKING & COOKIES DATA</h6>
        <p>
            We use cookies and similar tracking technologies to track the activity on our Service and we hold certain information.
        </p>
        <p>Cookies are files with a small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device. Other tracking technologies are also used such as beacons, tags and scripts to collect and track information and to improve and analyze our Service.</p>
        <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.</p>
        <h6>EXAMPLES OF COOKIES WE USE</h6>
        <p><b>Session Cookies:</b> We use Session Cookies to operate our Service.</p>
        <p><b>Preference Cookies:</b> We use Preference Cookies to remember your preferences and various settings.</p>
        <p><b>Security Cookies:</b> We use Security Cookies for security purposes.</p>
        <h6>USE OF DATA</h6>
        <p>
            <h6><b>DAVSY uses the collected data for various purposes:</b></h6>
                To provide and maintain the Service</br>
                To notify you about changes to our Service</br>
                To allow you to participate in interactive features of our Service when you choose to do so</br>
                To provide customer care and support</br>
                To provide analysis or valuable information so that we can improve the Service</br>
                To monitor the usage of the Service</br>
                To detect, prevent and address technical issues</br>
                <b>To provide your Site/Blog URL information to your Partner’s Site/Blog registered on DAVSY. To make your Partner’s Posts appear on your Site/Blog.</b>

        </p>
        <h6>TRANSFER OF DATA</h6>
        <p>Your information, including Personal Data, may be transferred to — and maintained on — computers located outside of your state, province, country or other governmental jurisdiction where the data protection laws may differ than those from your jurisdiction.</p>
        <p>If you are located outside India and choose to provide information to us, please note that we transfer the data, including Personal Data, to India and process it there.</p>
        <p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
        <p>DAVSY will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy and no transfer of your Personal Data will take place to an organization or a country unless there are adequate controls in place including the security of your data and other personal information.</p>
        <h5>DISCLOSURE OF DATA</h5>
        <h6>LEGAL REQUIREMENTS</h6>
        <p>
        <b>DAVSY may disclose your Personal Data in the good faith belief that such action is necessary to:</b></br>
        To comply with a legal obligation</br>
        To protect and defend the rights or property of DAVSY</br>
        To prevent or investigate possible wrongdoing in connection with the Service</br>
        To protect the personal safety of users of the Service or the public</br>
        To protect against legal liability
        </p>
        <h6>SECURITY OF DATA</h6>
        <p>The security of your data is important to us but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>
        <h6>SERVICE PROVIDERS</h6>
        <p>We may employ third party companies and individuals to facilitate our Service ("Service Providers"), to provide the Service on our behalf, to perform Service-related services or to assist us in analyzing how our Service is used.</p>
        <p>These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>
        <h6>LINKS TO OTHER SITES</h6>
        <p>Our Service may contain links to other sites that are not operated by us. If you click a third party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit.</p>
        <p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>
        <h6>CHILDREN'S PRIVACY</h6>
        <p>Our Service does not address anyone under the age of 18 ("Children").
We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Child has provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we take steps to remove that information from our servers.
</p>
        <h6>CHANGES TO THIS PRIVACY POLICY</h6>
        <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
        <p>We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the "effective date" at the top of this Privacy Policy.</p>
        <p>You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>
        <h6>CONTACT US</h6>
        <p>If you have any questions about this Privacy Policy, please contact us:</b>By visiting this page on our website: <a href="https://davsy.com/">DAVSY</a></b></p>
        
        
      </div>
    </div>
  </div>
</div>
