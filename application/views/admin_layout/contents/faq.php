<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Faq Content                    
                </h3>                
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
                <form method="post" action="<?php echo base_url() . ADMIN_ACTION_UPDATEFAQ; ?>">
                    <textarea id="faq" name="faq" rows="10" cols="80"><?php echo $faq; ?></textarea>
                    <div class="row" style='margin-top:10px'>				
                        <div class="col-md-2" >
                            <button type="submit" class ="btn btn-block btn-primary">Save</button>
                        </div>		
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() . 'plugins/jQuery/jQuery-2.2.0.min.js'; ?>"></script>

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
    $(function() {
        CKEDITOR.replace('faq');
    });
</script> 