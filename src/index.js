/**
 * Mobile Menu - JavaScript
 */
const mobileMenu = document.querySelector('#mobile-menu')
const mobileMenuButton = document.querySelector('#mobile-menu-button')
const mobileMenuCloseIcon = document.querySelector('#mobile-menu-close-icon')
const mobileMenuOpenIcon = document.querySelector('#mobile-menu-open-icon')

mobileMenuButton.addEventListener('click', () => {
  if (mobileMenu.classList.contains('hidden')) {
    mobileMenu.classList.remove('hidden')
    mobileMenuOpenIcon.style.display = 'block'
    mobileMenuCloseIcon.style.display = 'none'
  } else {
    mobileMenu.classList.add('hidden')
    mobileMenuOpenIcon.style.display = 'none'
    mobileMenuCloseIcon.style.display = 'block'
  }
})
