
<?php
$data['page_title']=@$headding;
$this->load->view('admin/includes/header',$data);

?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Customers</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                    <!-- <li class="breadcrumb-item active" aria-current="page">Library</li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="col-md-12" data-select2-id="15">
                        <div class="card">
                            <form class="form-horizontal" id="customer-form" action="javascript:;" data-action=<?=@$action?>>
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                <input type="hidden" name="id" value="<?=@$customer['id'];?>" id="id">
                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="first_name" placeholder="first name" value="<?=@$customer['first_name']?>" name="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="last_name" placeholder="last name" value="<?=@$customer['last_name']?>" name="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" placeholder="email" value="<?=@$customer['email']?>" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="phone" placeholder="phone" value="<?=@$customer['phone']?>" name="phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" placeholder="password" value="" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Confrim Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="c_password" placeholder=" confirm password" value="" name="c_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="custom-image" onchange="readURL(this);">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                            
                                                <img id="img-thumb_130" src="<?=$base_path.@$customer['thumb'];?>" <?php if(!@$customer['thumb']){?> style="display: none;" <?php } ?>>
                                              
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$customer['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$customer['status']=='I'){?> selected <?php } ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
            
<?php
$this->load->view('admin/includes/footer');

?>
<script type="text/javascript">


    $("#customer-form").validate({
    normalizer: function(value) {
        return $.trim(value);
    },
    rules: {
        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        email: {
            required: true,
            email:true,
            remote: {
                url: "<?=base_url('customers/check-email');?>",
                type: "post",
                data: {id : $('#id').val()}
            }
        },
        phone: {
            required: true,
        },
        password : {
            minlength : 5
        },
        c_password : {
            minlength : 5,
            equalTo : "#password"
        },
        status: {
            required: true
        },
        
    },
    messages: {
        first_name: {
            required: 'First Name is required'
        },
        last_name: {
            required: 'Last Name is required'
        },
        email: {
            required: 'Email is required',
            remote: "Email already in use!"
        },
        phone: {
            required: 'Phone is required',
        },
        status: {
            required: 'Status is required'
        },


    },
    submitHandler: function(form) {
        
        var image       = $('#custom-image').prop('files')[0];
        var first_name  = $('#first_name').val();
        var last_name   = $('#last_name').val();
        var email       = $('#email').val();
        var phone       = $('#phone').val();
        var password    = $('#password').val();
        var status      = $('#status').val();
        var id          = $('#id').val();

        var form_data   = new FormData();
        form_data.append('first_name', first_name);
        form_data.append('last_name', last_name);
        form_data.append('email', email);
        form_data.append('phone', phone);
        form_data.append('password', password);
        form_data.append('image', image);
        form_data.append('status', status);
        form_data.append('id', id);
        $.ajax({
            
            type: "POST",
            url: $("#customer-form").data('action'),
            data: form_data,
            dataType: "json",
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            async: false,
            beforeSend: function() {
                $('.overlay').show();
                $("body").addClass("loading");

            },
            success: function(res) {
                $('.overlay').hide();
                $("body").removeClass("loading");
                if (res.status == 'success') {
                    setTimeout(function() {
                        window.location.href = "<?=base_url('customers');?>";
                    }, 1000);
                } else {
                    $('.body').scrollTop();
                    $('.alert-danger').show();
                    $('.alert-danger').html(res.message);
                   
                }
            },
            error: function() {}
        });
        return false;
    }
});

</script>
