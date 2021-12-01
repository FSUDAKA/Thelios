import FR from './translation/fr-fr.js'

const tags = document.querySelectorAll('[trad-ref]')

tags.forEach((el) => {
    el.innerHTML = FR[el.getAttribute('trad-ref')]
})

console.log(tags);