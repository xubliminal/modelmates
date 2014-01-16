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
            $item.find('.js-thumb').attr('name', 'thumb');
            $item.find('.js-thumb').val(response.id);
            $item.find('.js-file-id').attr('name', 'images['+response.id+']');
            $item.find('.js-file-id').val(response.id);
            $item.find('.uploaded-photo-input .qq-upload-file').remove();
            $item.find('.uploaded-photo-input .qq-upload-size').remove();
            $item.find('.uploaded-photo-input .qq-upload-failed-text').remove();
        },
        params:{
            user:1,
            scope:'video',
            size:{
                name:'thumbsmall',
                width:150,
                height:120
            }
        }
    });
    
    
    
    $('.js-delete-image').click(function(){
        $(this).parents('.img-thumbnail-conrainer').remove();
        return false;
    });
    
    if(typeof video !== "undefined") {
        jwplayer('video-player').setup({
            file:video.file,
            image:video.image,
            width:606,
            height:346
        });
    } else {
        var uploader2 = new qq.FileUploader({
        element: document.getElementById('file_upload2'),
        action:'/ajax/upload',
        multiple:false,
        allowedExtensions:['mp4', 'm4v', 'f4v','mov','mpeg','ogm','ogv','wmv', 'webm', 'flv','3gp','3g2','3gpp','dat', 'asf', 'aff','avi','divx', 'dv'],
        sizeLimit:20971520,
        listElement:document.getElementById('uploaded-videos'),
        onComplete:function(id, fileName, response) {
            var item = this.listElement.firstChild;
            while(item.qqFileId !== id) { item = item.nextSibling;}
            $item = $(item);
            $item.append('<input type="hidden" name="file_id" value="'+response.id+'" />');
            alert('The file has been uploaded and it\'s being processed.');
        },
        params:{
            user:1,
            scope:'video',
            type:'video'
        }
    });
    }
});

