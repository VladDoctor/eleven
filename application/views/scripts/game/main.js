import PreloaderState from "./states/preloader-state.js";
import GameState from "./states/game-state.js";

const game = new Phaser.Game(window.innerWidth, window.innerHeight, Phaser.AUTO, document.getElementById('game'));
const Game = {};

game.state.add('Game', Game);

Game.init = function () {
  game.stage.disableVisibilityChange = true;
};

Game.preload = function () {
  new PreloaderState(game);
};

Game.create = function () {
  new GameState(game);
};

game.state.start('Game');