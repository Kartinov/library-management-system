module.exports = {
    content: ['./app/views/**/*.php'],
    theme: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};
