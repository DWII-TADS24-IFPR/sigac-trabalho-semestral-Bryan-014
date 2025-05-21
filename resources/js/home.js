let controlAside = false;
let mobileAsideBtn = document.querySelector('#mobile-aside-control');
let navigationsTexts = document.querySelectorAll('.navigation-text');
let asideLinksCont = document.querySelector('.aside-links');
let switchDarkModeBtn = document.querySelector('#modoToggle');

let showTimeout;

function setFullHeight() {
    const vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);

    validAsideMode();
}

window.addEventListener("DOMContentLoaded", () => {
    const el = document.querySelector('.aside-links');
    setTimeout(() => {
        const cond = el && el.matches(':hover');
        if (cond) {
            clearTimeout(showTimeout);
            showTimeout = setTimeout(() => {
                navigationsTexts.forEach((item) => {
                    item.classList.remove('force-opacity-none');
                })
            }, 348)
        }
    }, 100)
  });

function validAsideMode() {
    if (window.screen.availWidth > 1154) {
        asideLinksCont.addEventListener("mouseover", e => {
            clearTimeout(showTimeout);
            showTimeout = setTimeout(() => {
                navigationsTexts.forEach((item) => {
                    item.classList.remove('force-opacity-none');
                })
            }, 348)
        });
        asideLinksCont.addEventListener("mouseleave", e => {
            clearTimeout(showTimeout);
            navigationsTexts.forEach((item) => {
                item.classList.add('force-opacity-none');
            })
        });
    } else {
        mobileAsideBtn.addEventListener('click', e => {
            mobileAsideBtn.classList.toggle('close');
            asideLinksCont.classList.toggle('open');
            controlAside = !controlAside;
        });
    }
}

window.addEventListener('load', setFullHeight);
window.addEventListener('resize', setFullHeight);
window.addEventListener('orientationchange', setFullHeight);

function aplicarTemaSalvo() {
    const temaSalvo = localStorage.getItem('tema');

    if (temaSalvo) {
        if (temaSalvo == 'dark') {
            switchDarkModeBtn.checked = true
        }
        document.documentElement.setAttribute('data-theme', temaSalvo);
    } else {
        document.documentElement.setAttribute('data-tema', 'light');
    }
}

switchDarkModeBtn.addEventListener('change', () => {
    const temaAtual = document.documentElement.getAttribute('data-theme');
    const novoTema = temaAtual === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', novoTema); //switchDarkModeBtn.checked ? 'dark' : 'light'
    localStorage.setItem('tema', novoTema);
})

aplicarTemaSalvo()