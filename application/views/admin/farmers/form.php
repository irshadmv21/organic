
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
                        <h4 class="page-title">Farmers</h4>
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
                            <form class="form-horizontal" id="farmer-form" action="javascript:;" data-action=<?=@$action?>>
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                <input type="hidden" name="id" value="<?=@$farmer['id'];?>" id="id">
                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Farmer Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="Banner Name" value="<?=@$farmer['name']?>" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="product_code" placeholder="Code" value="<?=@$farmer['product_code']?>" name="product_code">
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
                                            
                                                <img id="img-thumb_130" src="<?=$base_path.@$farmer['thumb'];?>" <?php if(!@$farmer['thumb']){?> style="display: none;" <?php } ?>>
                                              
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$farmer['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$farmer['status']=='I'){?> selected <?php } ?>>Inactive</option>
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
    
    $("#farmer-form").validate({
    normalizer: function(value) {
        return $.trim(value);
    },
    rules: {
        name: {
            required: true
        },
        product_code: {
            required: true
        },

        status: {
            required: true
        }
        
    },
    messages: {
        name: {
            required: 'Name is required'
        },
        product_code: {
            required: 'Code is required'
        }
    },
    submitHandler: function(form) {
        var image           = $('#custom-image').prop('files')[0];
        var name            = $('#name').val();
        var product_code    = $('#product_code').val();
        var status          = $('#status').val();
        var id              = $('#id').val();
        var form_data       = new FormData();
        form_data.append('name', name);
        form_data.append('image', image);
        form_data.append('product_code', product_code);
        form_data.append('status', status);
        form_data.append('id', id);
        
        $.ajax({
            type: "POST",
            url: $("#farmer-form").data('action'),
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
                        window.location.href = "<?=base_url('farmers');?>";
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
