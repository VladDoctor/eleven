export default class PreloaderState extends Phaser.State {
  constructor(game) {
    super(game);
    
    console.log('preloader state has started')
    this.preload(game);
  }

  preload(game) {
  }
}