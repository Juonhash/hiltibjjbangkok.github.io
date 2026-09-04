(function(){
  var btn = document.querySelector('.nav-hamburger');
  var menu = document.getElementById('nav-menu');
  if(!btn||!menu) return;
  btn.addEventListener('click', function(){
    var open = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', String(!open));
    menu.classList.toggle('open', !open);
  });
  menu.querySelectorAll('a').forEach(function(a){
    a.addEventListener('click', function(){
      btn.setAttribute('aria-expanded','false');
      menu.classList.remove('open');
    });
  });
  document.addEventListener('click', function(e){
    if(!btn.contains(e.target) && !menu.contains(e.target)){
      btn.setAttribute('aria-expanded','false');
      menu.classList.remove('open');
    }
  });
})();
