
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
                        <h4 class="page-title">Products</h4>
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
                                <input type="hidden" name="id" value="<?=@$product['id'];?>" id="id">
                                <div class="card-body">
                                    <h4 class="card-title"><?=@$headding?></h4>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="Enter name" value="<?=@$product['name']?>" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="description" name="description" placeholder="Enter description"><?=@$product['description']?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="price" placeholder="Enter price" value="<?=@$product['name']?>" name="price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="offer_percentage" class="col-sm-3 text-right control-label col-form-label">Offer (%)</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="offer_percentage" placeholder="Enter offer percentage  " value="<?=@$product['offer_percentage']?>" name="offer_percentage">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="qty" class="col-sm-3 text-right control-label col-form-label">Quantity</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="qty" placeholder="Quantity" value="<?=@$product['qty']?>" name="qty">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="is_home" class="col-sm-3 text-right control-label col-form-label">Options</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                                <input type="checkbox" class="custom-control-input"  id="is_home" name="is_home" value="Y" <?php if(@$category['is_home']=='Y'){ echo 'checked';}?>>
                                                <label class="custom-control-label" for="is_home" >Yes</label>
                                            </div>
                                                <button id="option-btn" class="col-2 btn btn-primary float-right" >Add<i class="mdi mdi-plus"></i></button>
                                            <div class="row " id="option-div">
                                                <div class="row ">
                                                    <div class="col-3"><input type="text" name="option_name" class="form-control"  placeholder="option name"></div>
                                                    <div class="col-3"><input type="number" name="option_price" class="form-control"  placeholder="price"></div>
                                                    <div class="col-2"><input type="number" name="option_quantity" class="form-control"  placeholder="quantity"></div>
                                                    <div class="col-2">
                                                        <select name="price_prifix" class="form-control">
                                                            <option class="+">+</option>
                                                            <option class="-">-</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-2"><button class="btn btn-danger" title="delete"><span class="fas fa-trash"></span></button></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label  class="col-sm-3 text-right control-label col-form-label">Category</label>
                                        <div class="col-md-9">
                                            <select class="select2 form-control m-t-15" multiple="multiple" name="category_id[]">
                                                <option></option>
                                                <?php if($categories){ ?>
                                                    <?php foreach ($categories as $key => $value) {?>
                                                        <?php if(in_array($value['id'], $category_ids)){?>
                                                            <option value="<?=$value['id']?>" selected><?php  if($value['parent_name'] != null){ echo $value['parent_name'].'->'.$value['name']; }else{ echo $value['name']; }?></option>
                                                        <?php }else{ ?>
                                                            <option value="<?=$value['id']?>"><?php  if($value['parent_name'] != null){ echo $value['parent_name'].'->'.$value['name'];}else{ echo $value['name']; }?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Dispaly Image</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="custom-image" onchange="readURL(this);" >
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                            
                                                <img id="img-thumb_130" src="<?=$base_path.@$product['thumb'];?>" <?php if(!@$product['thumb']){?> style="display: none;" <?php } ?>>
                                              
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status" id="status">
                                                <option value="A" <?php if(@$product['status']=='A'){?> selected <?php } ?>>Active</option>
                                                <option value="I" <?php if(@$product['status']=='I'){?> selected <?php } ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <!-- <a href="javascript:void(0)" onclick="$('#pro-image').click()" class="custom-file-label form-control" for="validatedCustomFile">Upload Image</a> -->
                                            <!-- <label class="custom-file-label" for="validatedCustomFile">Choose file...</label> -->
                                            <!-- <div class="invalid-feedback">Example invalid custom file feedback</div> -->
                                            <div class="custom-file">
                                                <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
                                                <label class="custom-file-label" for="validatedCustomFile" onclick="$('#pro-image').click()">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                            <!-- <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple> -->
                                            <div class="custom-file">
                                                <div class="preview-images-zone">
                                                    <div class="preview-image preview-show-1">
                                                        <div class="image-cancel text-danger" data-no="1"><span class="fas fa-trash"></span></div>
                                                        <div class="image-zone"><img id="pro-img-1" src="https://img.purch.com/w/660/aHR0cDovL3d3dy5saXZlc2NpZW5jZS5jb20vaW1hZ2VzL2kvMDAwLzA5Ny85NTkvb3JpZ2luYWwvc2h1dHRlcnN0b2NrXzYzOTcxNjY1LmpwZw=="></div>
                                                        <!-- <div class="tools-edit-image"><a href="javascript:void(0)" data-no="1" class="btn btn-light btn-edit-image">edit</a></div> -->
                                                    </div>
                                                </div>
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
                $("body").addClass("loading");
            },
            success: function(res) {
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
$('#option-btn').on('click',function(){
    var html="";
    html +='<div class="row">';
    html +='<div class="row">';
    html +='<div class="col-3"><input type="text" name="option_name" class="form-control"  placeholder="option name"></div>';
    html +='<div class="col-3"><input type="number" name="option_price" class="form-control"  placeholder="price"></div>';
    html +='<div class="col-2"><input type="number" name="option_quantity" class="form-control"  placeholder="quantity"></div>';
    html +='<div class="col-2">';
    html +='<select name="price_prifix" class="form-control">';
    html +='<option class="+">+</option>';
    html +='<option class="-">-</option>';
    html +='</select>';
    html +='</div>';
    html +='<div class="col-2"><button class="btn btn-danger" title="delete"><span class="fas fa-trash"></span></button></div>';
    html +='</div>';
    $('#option-div').append(html);
})
</script>
