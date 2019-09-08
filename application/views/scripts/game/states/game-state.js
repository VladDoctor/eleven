export default class GameState extends Phaser.State {
  constructor(game) {
    super(game);

    this.game = game;

    console.log('game state has started');
  }
}