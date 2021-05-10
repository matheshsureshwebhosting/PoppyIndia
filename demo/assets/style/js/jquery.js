var html = document.documentElement;
var body = document.body;

var scroller = {
  target: document.querySelector("#scroll-container"),
  ease: 0.05, // <= scroll speed
  endY: 0,
  y: 0,
  resizeRequest: 1,
  scrollRequest: 0,
};

var requestId = null;

TweenLite.set(scroller.target, {
  rotation: 0,
  force3D: true
});

window.addEventListener("load", onLoad);

function onLoad() {
  updateScroller();
  window.focus();
  window.addEventListener("resize", onResize);
  document.addEventListener("scroll", onScroll);
}

function updateScroller() {

  var resized = scroller.resizeRequest > 0;

  if (resized) {
    var height = scroller.target.clientHeight;
    body.style.height = height + "px";
    scroller.resizeRequest = 0;
  }

  var scrollY = window.pageYOffset || html.scrollTop || body.scrollTop || 0;

  scroller.endY = scrollY;
  scroller.y += (scrollY - scroller.y) * scroller.ease;

  if (Math.abs(scrollY - scroller.y) < 0.05 || resized) {
    scroller.y = scrollY;
    scroller.scrollRequest = 0;
  }

  TweenLite.set(scroller.target, {
    y: -scroller.y
  });

  requestId = scroller.scrollRequest > 0 ? requestAnimationFrame(updateScroller) : null;
}

function onScroll() {
  scroller.scrollRequest++;
  if (!requestId) {
    requestId = requestAnimationFrame(updateScroller);
  }
}

function onResize() {
  scroller.resizeRequest++;
  if (!requestId) {
    requestId = requestAnimationFrame(updateScroller);
  }

}


//------Srcll To Option--------//

// https://stackoverflow.com/questions/20947529/what-does-ahref-nothref-code-mean/20947599
var linksWithHash = document.querySelectorAll('a[href*=\\#]:not([href=\\#])')

linksWithHash.forEach((link) => {
  link.addEventListener('click', autoscrollToHere);
});

function autoscrollToHere() {
  
  // https://stackoverflow.com/questions/25987451/javascript-smooth-scroll-explained
  if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
  
    event.preventDefault();   

    gsap.to(window, { duration: 0, delay: 0.0, scrollTo: { y: this.hash, offsetY: 0 }, ease: "power4.inOut" } );

  }
}


//---------MENU-----------//

const btn = document.querySelector(".bn");
const box = document.querySelector("#n");

btn.addEventListener("click", function() {
  if (!box.classList.contains("active")) {
    TweenMax.to('#n', {
      autoAlpha: 1, display:'flex'
    });
    TweenMax.fromTo('#n .nl .bg', {height: "0%"}, {duration: 0.5, height: "100%"});
    TweenMax.fromTo('#n .nr .bg', {height: "0%"}, {duration: 0.5, height: "100%"});
    TweenMax.fromTo('#n .nl .nlc', {x: "-100%"}, {delay: 0.5, x: "27%"});
    TweenMax.fromTo('.phoneandportal', {x: "100%"}, {delay: 0.8, x: "5%"});
    TweenMax.fromTo('#n .nl .nrc', {x: "-72%", y: 550}, {delay: 0.8,  x: "-72%", y: 350});
    box.classList.add("active");
  } else {
    TweenMax.to('#n', {
      delay: 1,
      autoAlpha: 1,
      display:'none',
    });
    TweenMax.fromTo('#n .nl .bg', {height: "100%"}, {duration: 0.5, delay: 0.5, height: "0%"});
    TweenMax.fromTo('#n .nr .bg', {height: "100%"}, {duration: 0.5, delay: 0.5, height: "0%"});
    TweenMax.fromTo('#n .nl .nlc', {x: "27%"}, {x: "-100%"});
    TweenMax.fromTo('.phoneandportal', {x: "5%"}, {x: "100%"});
    TweenMax.fromTo('#n .nl .nrc', {x: "-72%", y: 350}, {x: "-72%", y: 550});
    box.classList.remove("active");
  }
});
