@extends('layouts.app')

@section('content')

<?php
    $users = App\User::all();
?>



    <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Ime</th>
                <th scope="col">E-mail</th>
                <th scope="col">Uloga</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>

            <tbody>
            
            @foreach($users as $user)
            <tr>
                <!--ID -->
                <th scope="row">
                    {{$user->id}}
                </th>

                <!-- IME -->
                <td>
                    {{$user->name}}    
                </td>

                <!-- EMAIL -->
                <td>
                    {{$user->email}}    
                </td>

                <!-- ROLE/ULOGA-->
                <td>
                    @if(($user->role)==1)
                        Head Admin
                    @elseif(($user->role)==2)
                        Admin
                    @elseif(($user->role)==3)
                        Korisnik
                    @endif
                </td>

                <!-- IZBRIŠI KORISNIKA -->
                <td>
                    <a href="/deleteUser/{{$user->id}}">
                        <button class="btn btn-primary">
                            Izbriši
                        </button>
                    </a>
                </td>

                <!-- UREDU KORISNIKA -->
                <td>
                    <a href="/editUser/{{$user->id}}">
                        <button class="btn btn-primary">
                            Uredi
                        </button>
                    </a>
                </td>                
            </tr>
            @endforeach
            
            </tbody>
          </table>


@endsection