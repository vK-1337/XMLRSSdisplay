const navBar = document.getElementById('navBar')
const body = document.getElementById('documentBody')
const dayLinks = document.getElementsByClassName('linkBtnDay')
const nightLinks = document.getElementsByClassName('linkBtnNight')
const form = document.getElementById('nightModeForm')
const formBtn = document.getElementById('formBtn')
const dayBtn = document.getElementById('dayBtn')
const nightBtn = document.getElementById('nightBtn')
const footer = document.getElementById('footer')

dayBtn.addEventListener('click', () => {
  document.cookie = 'mode=day'
  window.location.reload()
})

nightBtn.addEventListener('click', () => {
  document.cookie = 'mode=night'
  window.location.reload()
})

if ( document.cookie === 'mode=night' ) {
  formBtn.style.backgroundColor = 'black'
  nightBtn.style.display = 'none'
  dayBtn.style.display = 'block'
  navBar.style.backgroundColor = 'black'
  body.style.backgroundColor = '#12263A'
  body.style.color = 'white'
  footer.style.backgroundColor = 'black'
} else if ( document.cookie === 'mode=day' ) {
  dayBtn.style.display = 'none'
  nightBtn.style.display = 'block'
  navBar.style.backgroundColor = '#12263A'
  body.style.backgroundColor = 'white'
  body.style.color = 'black'
  footer.style.backgroundColor = '#12263A'
}
