$(function(){
    $('input[name=role_id]').change(function(){
        if($(this).hasClass('free')) {
            $('#payment').addClass('hide');
        } else {
            $('#payment').removeClass('hide');
        }
        console.log(this);
    });
    
    $('.js-next-step').click(function(){
        
        // Validate ...
        
        $next = $(this).attr('href');
        $(this).parents('.jr-main').addClass('hide');
        $($next).removeClass('hide');
        
        $active = $('#join-steps .active');
        console.log($active);
        $active.removeClass('active');
        $active.next().addClass('active');
    });
    
    $('input[name="nickname"]').focus();
    
    var userID = $('input[name=user]').val();
    
    var uploader = new qq.FileUploader({
        element: document.getElementById('file_upload'),
        action: '/ajax/upload',
        multiple:true,
        allowedExtensions:['jpg', 'jpeg', 'png', 'gif'],
        sizeLimit:20971520,
        listElement:document.getElementById('uploaded-photos'),
        fileTemplate:$('.js-upload-template').html(),
        onProgress:function(id, fileName, loaded, total){
            var item = this.listElement.firstChild;
            while(item.qqFileId !== id) { item = item.nextSibling;}
            $item = $(item);
            
            progress = loaded / total * 100;
            $item.find('.progress div').css({
                width:progress+'%'
            });            
        },
        onComplete:function(id, fileName, response) {
            var item = this.listElement.firstChild;
            while(item.qqFileId !== id) { item = item.nextSibling;}
            $item = $(item);
            
            $item.find('.uploaded-photo-pic').html(response.image);
            $item.find('.uploaded-photo-input .qq-upload-file').remove();
            $item.find('.uploaded-photo-input .qq-upload-size').remove();
            $item.find('.uploaded-photo-input .qq-upload-failed-text').remove();
            
        },
        params:{
            user:userID,
            size:{
                name:'thumbbig',
                width:156,
                height:156
            }
        }
    });
    
    function readURL(input) {
        console.log(input.files);
        
    }

    $("#imgInp").change(function(){
        readURL(this);
    });
});