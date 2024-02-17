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

/**
 * Audio player
 */

// get post id
const bodyClasses = document.body.className.split(' ')
const postId = bodyClasses.find(className => className.startsWith('postid-')).split('-')[1]

// get next and previous post
const posts = JSON.parse(ourData.posts)
const nextPost = posts.find(post => post.id == postId + 1)
const prevPost = posts.find(post => post.id == postId - 1)

const audioPlayer = document.querySelector('#audio-player')
const playButton = document.querySelector('#play-button')
const pauseButton = document.querySelector('#pause-button')
const audio = document.querySelector('#audio')
const audioTitle = document.querySelector('#audio-title')
const audioArtist = document.querySelector('#audio-artist')
const audioCover = document.querySelector('#audio-cover')
const audioProgress = document.querySelector('#audio-progress')
const audioProgressContainer = document.querySelector('#audio-progress-container')
const audioCurrentTime = document.querySelector('#audio-current-time')
const audioDuration = document.querySelector('#audio-duration')
const audioLoading = document.getElementById('audio-loading')

let isPlaying = false
let currentSongIndex = postId
let audioSrc = ''

async function fetchSongs() {
  const songsPromise = await fetch(ourData.root_url + `/wp-json/wp/v2/posts/${postId}`)
  const postData = await songsPromise.json()
  loadSong(postData)
}

function loadSong(post) {
  audio.src = post.meta['the-audio-of-the-lesson']
  audioProgress.style.width = '0' // Reset progress bar
}

function playSong() {
  isPlaying = true
  audioPlayer.classList.add('playing')
  playButton.classList.add('hidden')
  pauseButton.classList.remove('hidden')
  audio.play()
}

function pauseSong() {
  isPlaying = false
  audioPlayer.classList.remove('playing')
  playButton.classList.remove('hidden')
  pauseButton.classList.add('hidden')
  audio.pause()
}

function updateProgress(e) {
  const {duration, currentTime} = e.srcElement
  const progressPercent = (currentTime / duration) * 100
  audioProgress.style.width = `${progressPercent}%`
  const durationMinutes = Math.floor(duration / 60)
  let durationSeconds = Math.floor(duration % 60)
  if (durationSeconds < 10) {
    durationSeconds = `0${durationSeconds}`
  }
  if (durationSeconds) {
    audioDuration.textContent = `${durationMinutes}:${durationSeconds}`
  }
  const currentTimeMinutes = Math.floor(currentTime / 60)
  let currentTimeSeconds = Math.floor(currentTime % 60)
  if (currentTimeSeconds < 10) {
    currentTimeSeconds = `0${currentTimeSeconds}`
  }
  audioCurrentTime.textContent = `${currentTimeMinutes}:${currentTimeSeconds}`
}

function setProgress(e) {
  const width = this.clientWidth
  const clickX = e.offsetX
  const duration = audio.duration
  audio.currentTime = duration - (clickX / width) * duration
}

// Event listeners
playButton.addEventListener('click', () => (isPlaying ? pauseSong() : playSong()))
pauseButton.addEventListener('click', () => (isPlaying ? pauseSong() : playSong()))
audio.addEventListener('timeupdate', updateProgress)
audioProgressContainer.addEventListener('click', setProgress)
audio.addEventListener('loadedmetadata', () => {
  const duration = audio.duration
  const durationMinutes = Math.floor(duration / 60)
  let durationSeconds = Math.floor(duration % 60)
  if (durationSeconds < 10) {
    durationSeconds = `0${durationSeconds}`
  }
  audioDuration.textContent = `${durationMinutes}:${durationSeconds}`
})

// Show or Hide loading effect when the audio is waiting for data or playing
audio.addEventListener('waiting', () => {
  audioLoading.classList.remove('hidden')
})
audio.addEventListener('playing', () => {
  audioLoading.classList.add('hidden')
})
audio.addEventListener('ended', () => {
  audioLoading.classList.add('hidden')
})

// add fast forward and rewind
document.getElementById('fast-rewind').addEventListener('click', () => {
  audio.currentTime -= 10
})
document.getElementById('fast-forward').addEventListener('click', () => {
  audio.currentTime += 10
})

// add volume control
// document.getElementById('volume').addEventListener('change', function () {
//   audio.volume = this.value / 100
// })

// add play speed control
document.getElementById('play-speed').addEventListener('change', function () {
  audio.playbackRate = this.value
})

fetchSongs()
