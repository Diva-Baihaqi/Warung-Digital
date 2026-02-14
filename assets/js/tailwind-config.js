tailwind.config = {
  theme: {
    extend: {
      colors: {
        "neo-bg": "#FFFDF5",
        "neo-black": "#000000",
        "neo-accent": "#FF6B6B", // Red
        "neo-secondary": "#FFD93D", // Yellow
        "neo-muted": "#C4B5FD", // Violet
        "neo-white": "#FFFFFF",
      },
      fontFamily: {
        sans: ['"Space Grotesk"', "sans-serif"],
      },
      boxShadow: {
        "neo-sm": "4px 4px 0px 0px #000",
        neo: "8px 8px 0px 0px #000",
        "neo-lg": "12px 12px 0px 0px #000",
        "neo-xl": "16px 16px 0px 0px #000",
      },
      borderWidth: {
        3: "3px",
        4: "4px",
        8: "8px",
      },
      rotate: {
        1: "1deg",
        2: "2deg",
        3: "3deg",
      },
    },
  },
};
