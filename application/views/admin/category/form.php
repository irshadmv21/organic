
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
                        <h4 class="page-title">Categories</h4>
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
                            <form class="form-horizontal" id="category-form" action="javascript:;" data-action=<?=@$action?>>
                                <div class="alert alert-danger" role="alert" style="display: none;" >
                                    
                                </div>
                                <input type="hidden" name="id" value="<?=@$category['id'];?>" id="id">
                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Category Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="Banner Name" value="<?=@$category['name']?>" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Parent category</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="" >Please choose parent category (optional)</option>
                                                <?php foreach($categories as $key=>$value){ ?>
                                                <option value="<?=$value['id']?>" <?php if(@$category['parent_id']==$value['id']){?> selected <?php } ?>><?=@$value['name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="is_home" class="col-sm-3 text-right control-label col-form-label">Is Display Home</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input"  id="is_home" name="is_home" value="Y" <?php if(@$category['is_home']=='Y'){ echo 'checked';}?>>
                                                <label class="custom-control-label" for="is_home" >Yes</label>
                                            </div>
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
                                            
                                                <img id="img-thumb_130" src="<?=$base_path.@$category['thumb'];?>" <?php if(!@$category['thumb']){?> style="display: none;" <?php } ?>>
                                              
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$category['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$category['status']=='I'){?> selected <?php } ?>>Inactive</option>
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
    
    $("#category-form").validate({
    normalizer: function(value) {
        return $.trim(value);
    },
    rules: {
        name: {
            required: true
        },
        status: {
            required: true
        }
        
    },
    messages: {
        name: {
            required: 'Name is required'
        }
    },
    submitHandler: function(form) {
        if ($("#is_home").is(":checked")) { 
            var is_home ='Y';
        }else{
            var is_home = 'N';
        }
        console.log(is_home);


        var image = $('#custom-image').prop('files')[0];
        var name = $('#name').val();
        var status = $('#status').val();
        var parent_id = $('#parent_id').val();
        var id = $('#id').val();
        var form_data = new FormData();
        form_data.append('name', name);
        form_data.append('image', image);
        form_data.append('status', status);
        form_data.append('parent_id', parent_id);
        form_data.append('is_home', is_home);
        form_data.append('id', id);
        //$("body").addClass("loading");
        $.ajax({
            type: "POST",
            url: $("#category-form").data('action'),
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
                        window.location.href = "<?=base_url('categories');?>";
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
