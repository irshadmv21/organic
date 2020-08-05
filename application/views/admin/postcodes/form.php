
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
                        <h4 class="page-title">Postcode</h4>
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
                            <form class="form-horizontal" id="postcode-form" action="javascript:;" data-action=<?=@$action?>>
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                <input type="hidden" name="id" value="<?=@$postcode['id'];?>" id="id">
                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Location Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="Enter location name" value="<?=@$postcode['name']?>" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="postcode" class="col-sm-3 text-right control-label col-form-label">Postcode</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="postcode" placeholder="Enter postcode" value="<?=@$postcode['postcode']?>" name="postcode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$postcode['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$postcode['status']=='I'){?> selected <?php } ?>>Inactive</option>
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
    
    $("#postcode-form").validate({
    normalizer: function(value) {
        return $.trim(value);
    },
    rules: {
        name: {
            required: true
        },
        postcode: {
            required: true,
            remote: {
                url: "<?=base_url('postcodes/check-exist');?>",
                type: "post",
                data: {id : $('#id').val()}
            }
        }
        
    },
    messages: {
        name: {
            required: 'Name is required'
        },
        postcode: {
            required: 'Postcode is required',
            remote:"Postcode already exist..!"
        }

    },
    submitHandler: function(form) {
        
        $.ajax({
            type: "POST",
            url: $("#postcode-form").data('action'),
            data: $("#postcode-form").serialize(),
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
                        window.location.href = "<?=base_url('postcodes');?>";
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
