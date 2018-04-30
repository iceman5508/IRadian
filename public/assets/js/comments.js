var url = 'http://localhost/Radian/api/';
var selected = iWeb.param('selected');

/**
 * Get all comments
 * @param videoId
 * @returns {string}
 */
function getComments() {
   var comments =  iHttpService.get(
        url
       ,{
            'api' : 'videos/getPosts/'+selected
       });

   return comments.data;
}

/**
 * Load comments
 * @param videoId
 */
function loadComments() {

    var commentBox = $('#comments');
    var comments = getComments(selected);
    for(var i=0; i<comments.length; i++){
        commentBox.html( commentBox.html()+'<p>'+comments[i].comment+'</p><hr>');
    }
}


if(!selected){}else{ loadComments(selected);}

/**
 * Post a comment
 */
function postComment() {
    var message =$('#commentArea').val();
    if(message.trim().length > 0) {
        var comment = iHttpService.post(
            url
            , {
                'api': 'videos/post/' + selected + '/' + message
            });

        if(comment.data){
            $('#commentArea').val('');
            var commentBox = $('#comments');
            $("#comments").prepend('<p>'+message+'</p><hr>');
        }
    }

}