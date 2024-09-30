$('body').append(`
  <div id="loading" style="display: none;background: #00000069;z-index: 10000;" class="position-fixed h-100 w-100 top-0 start-0">
      <div id="lottie-animation" class="bg-white rounded-3 border border-primary border-5 position-fixed start-50 top-50" style="width: 100px; height: 100px;transform: translate(-50%, -50%);">
      </div>
  </div>
`);

var animation = lottie.loadAnimation({
  container: document.getElementById('lottie-animation'),
  renderer: 'svg',
  loop: true,
  autoplay: true,
  path: 'https://lottie.host/e2cd747d-d002-401b-a06a-082f0eb9ef2d/FW7JXiPcpb.json' // Lottie animation URL
});
