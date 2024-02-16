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

/**
 * Select order
 */
if (document.getElementById('order')) {
  document.getElementById('order').addEventListener('change', function () {
    document.getElementById('orderForm').submit()
  })
}

/**
 * Search functionality
 */
const clonableContent = document.querySelector('#li-template').content
let ourTimer = null
let previousSearchValue = ''
const searchField = document.querySelector('#search-field')
const searchOverlay = document.querySelector('#search-overlay')

document.querySelector('#search-icon').addEventListener('click', openSearch)

function openSearch() {
  console.log('clicked')
  searchOverlay.classList.remove('invisible', 'opacity-0', 'scale-125')
  searchOverlay.classList.add('scale-100', 'opacity-100')

  setTimeout(() => {
    searchField.focus()
  }, 50)
}

document.querySelector('#close-overlay-icon').addEventListener('click', closeSearch)

function closeSearch() {
  searchOverlay.classList.add('scale-125', 'opacity-0')
  searchOverlay.classList.remove('scale-100', 'opacity-100')
  searchField.blur()
  setTimeout(() => {
    searchOverlay.classList.add('invisible')
  }, 301)
}

searchField.addEventListener('keyup', handleInputChange)

function handleInputChange(e) {
  // when to show spinner loader and hide default message
  if (e.target.value.trim() != previousSearchValue) {
    if (e.target.value.trim() != '') {
      document.querySelector('#loading-icon').classList.remove('hidden')
      document.querySelector('#default-message').classList.add('hidden')
      document.querySelector('#no-results-message').classList.add('hidden')
      document.querySelector('#results-area').classList.add('hidden')
    }

    if (e.target.value.trim() == '') {
      document.querySelector('#results-area').classList.add('hidden')
      document.querySelector('#loading-icon').classList.add('hidden')
      document.querySelector('#default-message').classList.remove('hidden')
      document.querySelector('#no-results-message').classList.add('hidden')
      clearTimeout(ourTimer)
      return
    }

    clearTimeout(ourTimer)

    ourTimer = setTimeout(() => {
      actuallyFetchData(e.target.value)
    }, 750)
  }

  previousSearchValue = e.target.value.trim()
}

async function actuallyFetchData(term) {
  // 1 actually fetch data
  const results = await getResultsData(term)
  console.log(results)

  if (results.length == 0) {
    document.querySelector('#no-results-message').classList.remove('hidden')
    document.querySelector('#loading-icon').classList.add('hidden')
    return
  }

  const wrapper = document.createDocumentFragment()
  results.forEach(item => {
    const clone = clonableContent.cloneNode(true)
    clone.querySelector('a').href = item.url
    clone.querySelector('.title-text').textContent = item.title
    wrapper.appendChild(clone)
  })

  document.querySelector('#results-area').innerHTML = ''
  document.querySelector('#results-area').appendChild(wrapper)

  document.querySelector('#results-area').classList.remove('hidden')
  document.querySelector('#loading-icon').classList.add('hidden')
}

async function getResultsData(term) {
  const resultsPromise = await fetch(ourData.root_url + `/wp-json/wp/v2/search?search=${term}`)
  const results = await resultsPromise.json()
  return results
}
