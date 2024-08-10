        <!-- jQuery  -->
        <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/main.min.js');?>"></script>
        <script src="<?php echo base_url('assets/js/toastr.min.js');?>"></script>
        <?php
            if(isset($scripts)) {
                foreach($scripts as $script) {
            ?>
            <script type="text/javascript" src="<?php echo base_url('assets/js/'.$script); ?>"></script>
            <?php
                }
            }
        ?>
        <script>
        const smooch = new SmoochCore({
            jwt: 'some-jwt',
                });
        </script>

    </body>
</html>
