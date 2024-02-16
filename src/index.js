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
    mobileMenuOpenIcon.style.display = 'none'
    mobileMenuCloseIcon.style.display = 'block'
  } else {
    mobileMenu.classList.add('hidden')
    mobileMenuOpenIcon.style.display = 'block'
    mobileMenuCloseIcon.style.display = 'none'
  }
})

/**
 * Desktop Menu - JavaScript
 */
document.addEventListener('DOMContentLoaded', function () {
  // Get all menu buttons
  var buttons = document.querySelectorAll('[id^="menu-button-"]')

  // Add click event listener to each button
  buttons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      console.log('click')
      // Close all open dropdown menus
      closeAllDropdowns()

      // Get the dropdown menu associated with this button
      var dropdownId = button.getAttribute('id').replace('menu-button-', 'dropdown-menu-')
      var dropdown = document.getElementById(dropdownId)

      // Toggle the 'hidden' class to show/hide the dropdown menu
      dropdown.classList.toggle('hidden')

      // Toggle the 'aria-expanded' attribute to indicate the state of the dropdown menu
      var expanded = dropdown.getAttribute('aria-expanded') === 'true' || false
      dropdown.setAttribute('aria-expanded', !expanded)

      // Stop event propagation to prevent immediate closing
      event.stopPropagation()
    })
  })

  // Add click event listener to the document body to close the dropdown menu when clicking outside of it
  document.body.addEventListener('click', function (event) {
    closeAllDropdowns()
  })

  // Function to close all dropdown menus
  function closeAllDropdowns() {
    buttons.forEach(function (button) {
      var dropdownId = button.getAttribute('id').replace('menu-button-', 'dropdown-menu-')
      var dropdown = document.getElementById(dropdownId)
      dropdown.classList.add('hidden')
      dropdown.setAttribute('aria-expanded', 'false')
    })
  }
})

/**
 * Go to top button
 * TODO not work!
 */
document.getElementById('top').addEventListener('click', function (event) {
  event.preventDefault()
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })
})
