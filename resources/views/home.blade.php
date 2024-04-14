@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pokedex') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="nomePokemon">Nome do Pokemon</label>
                                <input type="text" class="form-control" id="nomePokemon">
                            </div>
                        </div>
                        <div class="col-2" style="margin-top: 20px;">
                            <button class="btn btn-primary" onclick="pesquisar()">pesquisar</button>
                        </div>
                        <div class="col-2" style="margin-top: 20px;">
                            <button type="button" class="btn btn-primary" onclick="showFavoritos()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                                </svg>
                                Favoritos
                            </button>
                        </div>
                    </div>
                    <div class="row" id="dados">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <h1 id="nomeN" class="text-center"></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" id="pokemon-picture"></div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="type"></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="weight"></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 id="height"></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12" id="favorito">
                                            <button type="button" class="btn btn-secondary" onclick="addFavaorito()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dadosFavoritos"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var nome = '';
    var img = '';
    var type = '';
    var weight = '';
    var height = '';

    function pesquisar() {
        $.ajax({
            method: "GET",
            url: "https://pokeapi.co/api/v2/pokemon/" + $('#nomePokemon').val(),
            context: document.body
        }).done(function(pokemon) {

            nome = `${pokemon.name} Nº ${pokemon.id}`;
            img = `<img src="${pokemon.sprites.front_default}" alt="Sprite of ${pokemon.name}" style="width: 50%;">`;
            type = `Type: ${pokemon.types.map(item => ' ' + item.type.name).toString()}`;
            weight = `Weight: ${pokemon.weight  / 10}kg`;
            height = `Height: ${pokemon.height  / 10}m`;

            $('#nomeN').html(nome);
            $('#pokemon-picture').html(img);
            $('#type').html(type);
            $('#weight').html(weight);
            $('#height').html(height);

            $('#dados').show();
        });
    }

    function addFavaorito() {
        $.ajax({
            method: "POST",
            url: '{{route("favoritosAdd")}}',
            data: {
                nome: nome,
                img: img,
                type: type,
                weight: weight,
                height: height,
            },
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            }
        }).done(function(data) {
            var favorito = `<button type="button" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"></path>
                </svg>
              </button>`;

            $('#favorito').html(favorito);
        });
    }

    function showFavoritos() {
        $('#dados').hide();
        $.ajax({
            method: "POST",
            url: '{{route("favoritosShow")}}',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            }
        }).done(function(data) {
            $('#dadosFavoritos').html(data);
            $('#dadosFavoritos').show();
        });
    }

    function destroyFavaorito(id) {
        $('#dados').hide();
        $.ajax({
            method: "POST",
            url: '{{route("favoritosDestroy")}}',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            }
        }).done(function(data) {
            showFavoritos();
        });
    }

    $(document).ready(function() {
        $('#dados').hide();
        $('#dadosFavoritos').hide();
    });
</script>
@endsection