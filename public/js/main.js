var url = "http://127.0.0.1:8000";
window.addEventListener('load',  function () {
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');
    // boton de like
    function like() {
        $('.btn-like').unbind('click').click(function() {
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + '/images/heart-icon.png');
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('has dado dislike');
                    } else {
                        console.log('error ' + response);
                    }
                }
            })
            dislike();
        });
    }
    like();
    // boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function() {
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + '/images/heart-icon-red.png')
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if (response.like) {
                        console.log('has dado like');
                    } else {
                        console.log(response);
                    }
                }
            })
            like();
        })
    }
    dislike();
});
