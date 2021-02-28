var elixir = require('laravel-elixir');


elixir(function(mix) {
    mix.styles('app.css')
        .scripts('app.js');
});