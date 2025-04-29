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
        contrastText: {
          DEFAULT: "#333333", // Dark text for contrastText
          light: "#666666", // Light text for contrast
          dark: "#111111", // Dark text for contrast
        },
        warning: {
          DEFAULT: "#FFC107", // Base warning color
          light: "#FFD54F", // Lighter version
          dark: "#FFA000", // Darker version
        },
        error: {
          DEFAULT: "#DC3545", // Base error color
          light: "#E57373", // Lighter version
          dark: "#C82333", // Darker version
        },
        creamyWhite: "#FAF3E0", // Add creamy white color
        lightGray: "#e7dde7", // e7dde7   e6e0fe
      },
      fontFamily: {
        sans: ["Inter", "sans-serif"],
        heading: ["Poppins", "sans-serif"], // Font for headings
        body: ["Inter", "sans-serif"], // Font for body text
      },
    },
  },
  plugins: [
    function ({ addBase, theme }) {
      const colors = theme("colors");
      const cssVariables = Object.keys(colors).reduce((acc, colorKey) => {
        const color = colors[colorKey];
        if (typeof color === "string") {
          acc[`--tw-color-${colorKey}`] = color;
        } else {
          Object.keys(color).forEach((shade) => {
            acc[`--tw-color-${colorKey}-${shade}`] = color[shade];
          });
        }
        return acc;
      }, {});

      addBase({
        ":root": cssVariables,
      });
    },
  ],
};
