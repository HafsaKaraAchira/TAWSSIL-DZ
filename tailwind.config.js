module.exports = {
  content: [
    "./index.php",
    "./View/**/*.php",
    "./Assets/js/**/*.js",
    "./Assets/css/**/*.css",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#00864A",
        "primary-dark": "#006B3A",
        accentBlue: "#2ab5e4",
        accentYellow: "#EEB869",
        creamyWhite: "#FAF3E0", // Add creamy white color
        contrastText: "#333333", // Dark text for contrast
        logoAccent: "#EEB869", // Accent color for logo
      },
      fontFamily: {
        sans: ["Inter", "sans-serif"],
        heading: ["Poppins", "sans-serif"], // Font for headings
        body: ["Inter", "sans-serif"], // Font for body text
      },
    },
  },
  plugins: [],
};