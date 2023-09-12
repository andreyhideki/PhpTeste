import { PokemonClient } from 'pokenode-ts';

//https://pokeapi.co/docs/v2
(async () => {
    const api = new PokemonClient();

    await api
        .getPokemonByName('luxray')
        .then((data) => console.log(data.name)) // will output "Luxray"
        .catch((error) => console.error(error));
})();