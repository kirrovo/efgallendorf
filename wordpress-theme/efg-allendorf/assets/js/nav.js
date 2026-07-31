/* Mobil-Navigation: Disclosure-Muster, tastaturbedienbar. */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.nav-toggle');
    var menu = document.getElementById('hauptnavigation');
    if (!toggle || !menu) { return; }

    function schliessen() {
      toggle.setAttribute('aria-expanded', 'false');
      menu.classList.remove('offen');
    }

    toggle.addEventListener('click', function () {
      var offen = toggle.getAttribute('aria-expanded') === 'true';
      toggle.setAttribute('aria-expanded', String(!offen));
      menu.classList.toggle('offen', !offen);
    });

    menu.addEventListener('click', function (e) {
      if (e.target.closest('a')) { schliessen(); }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
        schliessen();
        toggle.focus();
      }
    });
  });
})();
