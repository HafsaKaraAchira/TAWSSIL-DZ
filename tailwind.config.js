// tailwind.config.js
module.exports = {
    content: [
        "./View/**/*.php",
        "./index.php",
        "./Assets/js/**/*.js",
        "./View/partials/diaporama.php"
    ],
    theme: {
        extend: {
            colors: {
                primary: "#00864A",
                accentBlue: "#2A96F1",
                accentYellow: "#EEB869",
            },
            fontFamily: {
                sans: ["Inter", "sans-serif"],
                heading: ["Poppins", "sans-serif"],
            }
        },
    },
    plugins: [],
};
// tailwind.config.js