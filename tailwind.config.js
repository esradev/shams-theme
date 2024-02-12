const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  content: ['./**/*.php', './src/**/*.js'],
  plugins: [require('@tailwindcss/typography')],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Noto Sans Arabic', ...defaultTheme.fontFamily.sans]
      }
    }
  }
}
