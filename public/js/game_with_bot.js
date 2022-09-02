$(function(){

    //making sure that players are indicated WITH BOTS
    $(document).on('change', '#player_1_with_bot', function(e) {
        if($('#player_1_with_bot').val() != ""){
            $('#whosturn').text('Red Team Turn');
            $("#play_with_bot").val("true");
            $('#board').toggle();

        }else{
            alert('invalid input')
        }
    });

    //store current players
    $("#initiate_players_with_bot").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);


                //show the board after making sure players are ready




            },
            error: function(e) {
                console.log('AJAX load did not work');
                console.log(e);
            }
        });
    });
})
