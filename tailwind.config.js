/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            black: '#000000',
            white: "#FFFFFF",
            success: '#3772FF',
            danger: '#EF233C',
            base: {
                content: '#001A49',
                heading: '#0f1728',
            },
            gray: {
                DEFAULT: "#deddd6",
                light: "#F4F4F4",
                dark: "#8F8F8F",
            },
            primary: {
                DEFAULT: '#ADEFD1FF',
                light: '#e6e8ec',
                focus: '#3b404f',
                content: '#FFFFFF',
            },
            secondary: {
                DEFAULT: '#00203FFF',
            },
        }
    },
  },
  plugins: [],
}

