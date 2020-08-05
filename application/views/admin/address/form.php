
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
                        <h4 class="page-title">Address</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>">Home</a></li>
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
                            <form class="form-horizontal" id="address-form" action="javascript:;" data-action=<?=@$action?>>
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                <input type="hidden" name="id" value="<?=@$address['id'];?>" id="id">
                                <input type="hidden" name="customer_id" value="<?=@$user_id;?>" id="customer_id">

                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="first_name" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="first_name" placeholder="Enter first name" value="<?=@$address['first_name']?>" name="first_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="last_name" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="last_name" placeholder="Enter last name" value="<?=@$address['last_name']?>" name="last_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?=@$address['email']?>" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="phone" placeholder="Enter phone nmuber" value="<?=@$address['phone']?>" name="phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address_1" class="col-sm-3 text-right control-label col-form-label">Address 1</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address_1" placeholder="Enter address" value="<?=@$address['address_1']?>" name="address_1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address_2" class="col-sm-3 text-right control-label col-form-label">Address 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address_2" placeholder="Enter address" value="<?=@$address['address_2']?>" name="address_2">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="landmark" class="col-sm-3 text-right control-label col-form-label">Landmark</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="landmark" placeholder="Enter landmark" value="<?=@$address['landmark']?>" name="landmark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 text-right control-label col-form-label">City</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="city" placeholder="Enter city" value="<?=@$address['city']?>" name="city">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="district" class="col-sm-3 text-right control-label col-form-label">District</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="district" placeholder="Enter district" value="<?=@$address['district']?>" name="district">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Postcode</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="postcode" id="postcode">
                                                <option value="" >Select postcode</option>
                                                <?php foreach($postcodes as $key=>$value){ ?>
                                                <option value="<?=$value['id'];?>" <?php if($value['id'] == @$address['postcode'] ){?> selected <?php } ?>><?=$value['name'];?> - <?=$value['postcode'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label for="is_default" class="col-sm-3 text-right control-label col-form-label">Is default</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input"  id="is_default" name="is_default" value="Y" <?php if(@$address['is_default']=='Y'){ echo 'checked';}?>>
                                                <label class="custom-control-label" for="is_default" >Yes</label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$banner['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$banner['status']=='I'){?> selected <?php } ?>>Inactive</option>
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
    
    $("#address-form").validate({
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
            email:true
        },
        phone: {
            required: true
        },
        address_1: {
            required: true
        },
        landmark: {
            required: true
        },
        city: {
            required: true
        },
        postcode: {
            required: true
        },
        
    },
    messages: {
        first_name: {
            required: 'First name is required'
        },
        last_name: {
            required: 'Last name is required'
        },
        email: {
            required: 'Email name is required',
            email:'Please enter a valid email'
        },
        phone: {
            required: 'Phone name is required'
        },
        address_1: {
            required: 'Address name is required'
        },
        landmark: {
            required: 'Landmark name is required'
        },
        city: {
            required: 'City name is required'
        },
        postcode: {
            required: 'Postcode name is required'
        },
    },
    submitHandler: function(form) {
        $.ajax({
            type: "POST",
            url: $("#address-form").data('action'),
            data:$("#address-form").serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.overlay').show();
                $("body").addClass("loading");
            },
            success: function(res) {
                $('.overlay').hide();
                $("body").removeClass("loading");
                if (res.status == 'success') {
                    setTimeout(function() {
                        window.location.href = "<?=base_url('customers/address-list/'.$user_id);?>";
                    }, 1000);
                } else {
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
