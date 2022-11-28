// https://tailwindcss.com/docs/configuration
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function ({ addVariant }) {
      addVariant('scroll', '.scroll &');
      addVariant('hover,scroll', ['&:hover', '.scroll &']);
    })
  ],
  content: ["./index.php", "./app/**/*.php", "./resources/**/*.{php,vue,js}"],
  theme: {
    extend: {
      screens: {
        '-2xl': { max: '1535px' },
        // => @media (max-width: 1535px) { ... }

        '-xl': { max: '1279px' },
        // => @media (max-width: 1279px) { ... }

        '-lg': { max: '1023px' },
        // => @media (max-width: 1023px) { ... }

        '-md': { max: '767px' },
        // => @media (max-width: 767px) { ... }

        '-sm': { max: '639px' },
        // => @media (max-width: 639px) { ... }
      },
      colors: {
        'theme-primary': 'rgb(var(--theme-r1) var(--theme-g1) var(--theme-b1) / <alpha-value>)',
        'theme-fg-primary': 'var(--theme-text-color)',

        'fg-primary': 'rgb(var(--fg-color-primary) / <alpha-value>)',
        'fg-secondary': 'rgb(var(--fg-color-secondary) / <alpha-value>)',
        'fg-tertiary': 'rgb(var(--fg-color-tertiary) / <alpha-value>)',

        'bg-trans-l': 'var(--bg-color-trans-l)',
        'bg-trans-m': 'var(--bg-color-trans-m)',
        'bg-trans-d': 'var(--bg-color-trans-d)',

        'bg-primary': 'rgb(var(--bg-color-primary) / <alpha-value>)',
        'bg-secondary': 'rgb(var(--bg-color-secondary) / <alpha-value>)',
        'bg-tertiary': 'rgb(var(--bg-color-tertiary) / <alpha-value>)',

      }, // Extend Tailwind's default colors
      boxShadow: {
        'glow': '0 0 6px white',
        'drop': '0 1px 40px -8px rgb(0 0 0 / 0.5)',
        'spread': '0 0 40px -8px rgb(0 0 0 / 50%)',
      },
      animation: {
        'bounce-light': 'bounce-light 0.8s infinite',
        'elastic-f': 'elastic 0.4s',
        'spin-s': 'spin 10s linear infinite',
        'peek-in-l': 'peek-in-l 1s',
        'peek-in-t': 'peek-in-t 1s',
        'peek-in-t-f': 'peek-in-t 0.4s',
        'rotate': 'spin 1s',
      },
      keyframes: {
        'peek-in-l': {
          '0%': {
            'transform': 'translateX(-30px)',
            'opacity': 0,
          },
          '100%': {
            'transform': 'translateX(0)',
            'opacity': 1
          }
        },
        'peek-in-t': {
          '0%': {
            'transform': 'translateY(-30px)',
            'opacity': 0,
          },
          '100%': {
            'transform': 'translateY(0)',
            'opacity': 1
          }
        },
        'bounce-light': {
          '0%, 100%': {
            'transform': 'translateY(-10%)',
            'animation-timing-function': 'cubic-bezier(0.8, 0, 1, 1)'
          },
          '50%': {
            'transform': 'translateY(0)',
            'animation-timing-function': 'cubic-bezier(0, 0, 0.2, 1)'
          }
        },
        'elastic': {
          '0%': {
            'transform': 'scale(0)',
          },

          '55%': {
            'transform': 'scale(1)',
          },

          '70%': {
            'transform': 'scale(.95)',
          },

          '100%': {
            'transform': 'scale(1)',
          }
        }
      },
    },
  },
};
