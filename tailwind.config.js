module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.svelte",
    ],

    theme: {
        fontFamily: {
            sans: ['dana', 'sans-serif'],
        },
        extend: {},
    },

    plugins: [require("daisyui")],

    daisyui: {
        rtl: true,
        darkTheme: "night",
        themes: ["winter", "night"],
    }
};
