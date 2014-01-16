$(function(){
    console.log(MM);
    
    jwplayer('video-detail-left').setup({
        file:MM.video_file,
        image:MM.video_image,
        width:606,
        height:346
    });
});