$(function(){
    var player_turn = 1; //1 | 2
    var color_turn = {};
    color_turn[1] = "red";
    color_turn[2] = "blue";
    var line = 0;
    var count = 2;
    var last_selected = "";




    //setting up the board
    for (let i = 0; i < 42; i++) {
       $('#board').append("<div id='cell_"+ i + "' class='cell text-center'></div>");
    }

    //hide the board on load
    $('#board').toggle();



    //making sure that players are indicated
    $(document).on('change', '#player_1, #player_2', function(e) {
        if($('#player_1').val() != "" && $('#player_2').val() != ""){

            if( $('#player_1').val() != $('#player_2').val()){

                console.log("dapa");
                $('#board').toggle();
            }else{
                alert('invalid input')
            }
        }
    });





    //store current players
    $("#initiate_players").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                console.log(data);

                // $('#whosturn').text('Red Team Turn');
                // //show the board after making sure players are ready
                // $('#board').toggle();



            },
            error: function(e) {
                console.log('AJAX load did not work');
                console.log(e);
            }
        });
    });



    //on click events where the actual game take place
    $('.cell').each(function(){

        $(this).click(function(){


            $('.cell').each(function(){


                if( $(this).attr('data-id') == 1 || $(this).attr('data-id') == 2){
                    if($("#play_with_bot").val() != "" ){
                        if (count >= 42){
                            alert('draw');
                            return false;
                        }
                    }else{
                        if (count >= 43){

                            alert('draw');
                            return false;

                        }
                    }
                }

                console.log(count);
            })

            count++;



            // //check if cell calls
            // alert($(this).attr('id'));

            last_selected = $(this).attr('id');

            $(this).css('background-color',  color_turn[player_turn]);
            $(this).attr('data-id',  player_turn);

            changeTurn_checkWinner(player_turn);



        })
    })




    function changeTurn_checkWinner(p){
        if(p == 1){
            console.log('player 1');
            player_turn = 2;
            $('#whosturn').text('Blue Team Turn');

            if($("#play_with_bot").val() != ""){ //AI Decision Making
                AIDecisions();
            }

        }else{


            console.log('player 2');
                player_turn = 1;
                $('#whosturn').text('Red Team Turn');

        }



        //horizontal checking
        for (let i = 0; i < 42; i+=7) {
            for (let j = 0; j < 7; j++) {
                var selected_id = $("#cell_" + (i+j));
                if(selected_id.attr('data-id') == p){
                    line++;
                }else{
                    line = 0;
                }

                if(line >= 4){
                    declareWinner(p);
                }
            }
            //start with 0 for next loop
            line = 0;

        }


        //vertical checking
        for (let i = 0; i < 7; i++) {
            for (let j = 0; j < 42; j+=7) {
                var selected_id = $("#cell_" + (i+j));
                if(selected_id.attr('data-id') == p){
                    line++;
                }else{
                    line = 0;
                }

                if(line >= 4){
                    declareWinner(p);
                }
            }
            //start with 0 for next loop
            line = 0;

        }

        //diagonal checking
        var left = 0;
        var right = 3

        for (let i = 0; i < 3; i++) {
            for (let j = 0; j < 4; j++) {
                if($('#cell_' + left).attr('data-id') == p
                && $('#cell_' + (left + 8)).attr('data-id') == p
                && $('#cell_' + (left + 16)).attr('data-id') == p
                && $('#cell_' + (left + 24)).attr('data-id') == p){
                    declareWinner(p);
                }

                if($('#cell_' + right).attr('data-id') == p
                && $('#cell_' + (right + 6)).attr('data-id') == p
                && $('#cell_' + (right + 12)).attr('data-id') == p
                && $('#cell_' + (right + 18)).attr('data-id') == p){
                    declareWinner(p);
                }


                left++;
                right = left + 3;

            }

            left = i * 7 + 7;
            right = left + 3;

        }

    }





    function declareWinner(p){

        if($("#play_with_bot").val() != ""){
            if(p == 1){

                alert('WINNER: ' + $('#player_1_with_bot').val() + " of Red Team");

                $('#winner_bot').val($('#player_1_with_bot').val());
            }else{
                alert('WINNER: BOT');
                $('#winner_bot').val("BOT");
            }

            $('#initiate_players_with_bot').trigger('submit');

        }else{
            if(p == 1){

                alert('WINNER: ' + $('#player_1').val() + " of Red Team");
                $('#winner').val($('#player_1').val());
            }else{
                alert('WINNER: ' + $('#player_2').val() + " of Red Team");
                $('#winner').val($('#player_1_with_bot').val());
            }

            $('#initiate_players').trigger('submit');
        }

        location.reload();

    }




    function AIDecisions(){

        var id = last_selected.split("_")


        //FOR SINLGE ATTACKS
        $.ajax({
            type: "GET",
            url: '/dataset/' + id[1],
            success: function(data) {
                // console.log(data);

                //get one way human can win
                var random_series = Math.floor(Math.random() * data.length);

                //split the series of four to block it
                var AI_move = data[random_series].data.split(",")

                //removing human last move from AI's decision
                for( var i = 0; i <  AI_move.length; i++){
                    if (  AI_move[i] === id[1]) {
                        AI_move.splice(i, 1);
                    }
                }

                //getting the closest number from human move
                const closest = AI_move.reduce((a, b) => {
                    return Math.abs(b - id[1]) < Math.abs(a - id[1]) ? b : a;
                });


                // console.log(closest);

                if (  $("#cell_" +  closest).attr('data-id') == 1 ||  $("#cell_" +  closest).attr('data-id') == 2 ) {
                    AIDecisions();
                }else{
                    $("#cell_" +  closest).css('background-color', "blue");
                    $("#cell_" +  closest).attr('data-id',  2);
                    player_turn = 1;
                    changeTurn_checkWinner(2);
                }


            }
        });















    }





})
