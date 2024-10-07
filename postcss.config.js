export default {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        'postcss-preset-env': {
            stage: 3,
            features: {
                'text-size-adjust': false, // Eliminar -webkit-text-size-adjust
                'font-smoothing': false,   // Eliminar -moz-osx-font-smoothing
            },
        },
    },
};
