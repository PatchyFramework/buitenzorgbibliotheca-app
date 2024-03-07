/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
    "./src/**/*.{html,js}",
  ],
  theme: {
    extend: {
      colors: {
        'greenjabar' : '#028e58',
        'bluejabar' : '#1aa5dc',
        'yellowjabar' : '#febf30',
        'darkbluejabar' : '#2c8fce',
      },
    },
    fontFamily: {
      montserrat: 'Montserrat',
      poppins: 'Poppins',
      playfair: 'Playfair Display',
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

