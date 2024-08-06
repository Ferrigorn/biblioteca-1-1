/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
          fontFamily: {
              "gotisch": ["Grenze Gotisch", "sans-serif"]
          },
          colors: {
              "black": "#060606",
              "verdclar": "#33fec9"
          },

      },
    },
    plugins: [
      require("@designbycode/tailwindcss-text-shadow")({
          shadowColor: "#fff",
          shadowBlur: "3px",
          shadowOffsetX: "2px",
          shadowOffsetY: "2px",
      })
    ],
  }

