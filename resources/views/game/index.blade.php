<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>4inarow | Dumb AI</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ URL::asset('css/game.css') }}">
</head>

<body>
    <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
        aria-controls="offcanvasExample" style="position:absolute; right: 0; margin: 20px">
        Scoreboard
    </a>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Scoreboard</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Score</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($scoreboard as $item)
                        <tr>
                            <td>{{ $item->winner }}</td>
                            <td>{{ $item->total }}</td>

                        </tr>
                    @endforeach



                </tbody>
            </table>
        </div>
    </div>



    <input type="text" id="play_with_bot" hidden>
    <h1 class="border m-auto w-25 text-center"> 4 in a row game</h1>

    <div class="border m-auto w-50 mt-5">

        <div class="border m-auto w-75 p-3">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Player vs Player
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ route('game.store') }}" method="POST" id="initiate_players">

                                <input type="text" class="form-control" id="winner" name="winner"
                                    placeholder="winner" hidden>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 text-center p-2 bg-danger">

                                        <input type="text" class="form-control" id="player_1" name="player_1"
                                            placeholder="Enter Player 1">
                                    </div>

                                    <div class="col-lg-6 text-center p-2 bg-primary">

                                        <input type="text" class="form-control" id="player_2" name="player_2"
                                            placeholder="Enter Player 2">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Player vs Bot <span data-toggle="tooltip" data-placement="top"
                                title="This AI is not quite smart but can stop and predict your move, the smarter one is still work in progress and its main purpose is to stop every 2 chain occurs"
                                style="width: 30px; padding: 5px; border: 1px solid black; background-color: black; margin-left: 5px; border-radius: 50%; color:white; text-align: center; font-size: 18px;">?</span>
                        </button>

                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form action="{{ route('game.store') }}" method="POST" id="initiate_players_with_bot">
                                <input type="text" class="form-control" id="winner_bot" name="winner"
                                    placeholder="winner" hidden>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 text-center p-2 bg-danger">

                                        <input type="text" class="form-control" id="player_1_with_bot"
                                            name="player_1" placeholder="Enter Player 1">
                                    </div>

                                    <div class="col-lg-6 text-center p-2 bg-primary">

                                        <input type="text" class="form-control" id="player_2_with_bot"
                                            name="player_2" placeholder="Enter Player 2" value="MEGATRON" readonly>
                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>





        </div>


        <h4 class="border m-auto text-center " id="whosturn"></h4>
        <div class="border m-auto w-75 p-1 mt-2" id="board">




        </div>

    </div>

</body>

<script src="{{ URL::asset('js/game.js') }}"></script>
<script src="{{ URL::asset('js/game_with_bot.js') }}"></script>

<script>
    $(function() {
        $("[data-toggle=tooltip").tooltip();
    })
</script>

</html>
