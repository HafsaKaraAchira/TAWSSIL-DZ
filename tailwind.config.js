/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.php",
    "./View/**/*.php",
    "./Assets/js/**/*.js",
    "./View/partials/**/*.php"
  ],
  safelist: [
    "bg-primary",
    "text-white",
    "hover:bg-primary-dark",
    "bg-accentBlue",
    "bg-accentYellow"
  ],
  theme: {
    extend: {
      colors: {
        primary: "#00864A",
        "primary-dark": "#006B3A",
        accentBlue: "#2A96F1",
        accentYellow: "#EEB869"
      },
      fontFamily: {
        sans: ["Inter", "sans-serif"],
        heading: ["Poppins", "sans-serif"]
      }
    }
  },
  plugins: []
}
