/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    var uploader = new qq.FileUploader({
        element: document.getElementById('file_upload'),
        action:'/ajax/upload',
        multiple:false,
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
            $item.find('.img-thumbnail').html(response.image);
            $item.find('.js-file-id').attr('name', 'image');
            $item.find('.js-file-id').val(response.id);
            $item.find('.uploaded-photo-input .qq-upload-file').remove();
            $item.find('.uploaded-photo-input .qq-upload-size').remove();
            $item.find('.uploaded-photo-input .qq-upload-failed-text').remove();
            
            
        },
        onSubmit:function() {
            $('.img-thumbnail-conrainer').html('');
        },
        params:{
            user:1,
            scope:'event',
            size:{
                name:'thumbmed',
                width:150,
                height:120
            }
        }
    });
    
    $('.js-delete-image').click(function(){
        $(this).parents('.img-thumbnail-conrainer').remove();
        return false;
    });
    
    $('.js-date').datepicker({
        minDate:new Date(),
        dateFormat:'yy-mm-dd'
    });
    
    $('.js-time').timepicker();
    
    $i = 0;
    $('.js-add-new-cover').click(function(){
        $html = $($('.js-cover-template').html());
        $html.find('.js-cover-title').attr('name', 'covers['+$i+'][title]');
        $html.find('.js-cover-price').attr('name', 'covers['+$i+'][price]');
        $html.find('.js-cover-description').attr('name', 'covers['+$i+'][description]');
        $('.covers-container').append($html); $i++;
        
        activateDeleteCoverButton();
        return false;
    });
    
    function activateDeleteCoverButton() {
        $('.js-remove-cover').click(function(){
            $(this).parents('.cover-item').remove();
            return false;
        });
    } activateDeleteCoverButton();
});

