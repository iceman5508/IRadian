var url = 'http://localhost/IRadian/api/';

function getComments(videoId) {
   var comments =  iHttpService.get(
        url
       ,{
            'api' : 'videos/getPosts/'+videoId
       });

   return comments.data;



}

function loadComments(videoId) {

    var commentBox = $('#comments');
    var comments = getComments(videoId);
    for(var i=0; i<comments.length; i++){
        commentBox.html( commentBox.html()+'<p>'+comments[i].comment+'</p><hr>');
    }

}

console.log(iEnviornment.param('selected'));