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
        primary: {
          DEFAULT: "#00864A", // Base color
          light: "#33A76C", // Lighter version
          dark: "#006B3A", // Darker version
        },
        accentYellow: {
          DEFAULT: "#EEB869",
          light: "#F3C78A",
          dark: "#D99A4E",
        },
        accentBlue: {
          DEFAULT: "#1886e4",
          light: "#4FA3F0",
          dark: "#1269B0",
        },
        creamyWhite: "#FAF3E0", // Add creamy white color
        lightGray: "#e7dde7", // e7dde7   e6e0fe
        contrastText: "#333333", // Dark text for contrast
        lightText: "#666666", // Light text for contrast
        darkText: "#111111", // Dark text for contrast
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