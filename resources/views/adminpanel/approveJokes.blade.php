@extends('layouts.app')

@section('content')
    


    <table class="table">
        <thead>
                <th scope="col">Ime autora</th>
                <th scope="col">Text vica</th>
                <th scope="col"></th>
                <th scope="col"></th>
        </thead>
        
        <tbody>
            @foreach ($jokes as $joke)
                <!-- GET IME AUTORA PREKO user_id iz fore-->
                <?php
                    $Autori = App\User::where('id',$joke->user_id)->get();

                    foreach($Autori as $autor){
                        $imeAutora = $autor->name;
                    }
                ?>

                <tr>
                    <td>
                        {{$imeAutora}}
                    </td>

                    <td>
                        {{$joke->jokeText}}
                    </td>

                    <td>
                        <button onclick='location.href="/approveJoke/{{$joke->id}}"' class="btn btn-success">
                            Odobri
                        </button>
                    </td>

                    <td>
                        <button onclick='location.href="/declineJoke/{{$joke->id}}"' class="btn btn-danger">
                            Odbij
                        </button>
                    </td>
                </tr>   


            @endforeach
        </tbody>
    </table>


@endsection