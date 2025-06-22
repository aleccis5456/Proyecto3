/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  safelist: [
    'bg-blue-200', 'bg-blue-300', 'bg-blue-500',
    'bg-yellow-200', 'bg-yellow-300', 'bg-yellow-500',
    'bg-orange-200', 'bg-orange-300', 'bg-orange-500',
    'bg-green-200', 'bg-green-300', 'bg-green-500',
    'bg-red-200', 'bg-red-300', 'bg-red-500',
    'bg-blue-100', 'bg-yellow-100', 'bg-orange-100', 'bg-green-200', 'bg-red-100',
    'bg-blue-400', 'bg-yellow-400', 'bg-orange-400', 'bg-green-400', 'bg-red-400',
    'bg-blue-900', 'bg-yellow-900', 'bg-orange-900', 'bg-green-900', 'bg-red-900',
    'text-orange-800', 'text-orange-600',
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('flowbite/plugin')
  ],
}